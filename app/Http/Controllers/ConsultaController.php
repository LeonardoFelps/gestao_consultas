<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Medico;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Construtor da classe.
     * 
     * @param Medico $medico Instância do modelo Medico injetada pelo Laravel.
     * 
     * Decisão: Usar injeção de dependência para facilitar o acesso ao modelo Medico.
     */
    public function __construct(Medico $medico)
    {
        $this->medico = $medico;
    }

    /**
     * Exibe uma lista de consultas.
     *
     * @param Request $request Objeto contendo os dados da requisição.
     * @return \Illuminate\View\View Retorna a view com as consultas filtradas e paginadas.
     * 
     * Decisão: Adotar filtros dinâmicos para facilitar a busca por paciente ou médico,
     * além de utilizar paginação para melhorar a performance em listas grandes.
     */
    public function index(Request $request)
    {
        $consultas = Consulta::query()
            ->when($request->paciente, function ($query, $paciente) {
                $query->where('paciente', 'like', '%' . $paciente . '%');
            })
            ->when($request->medico, function ($query, $medico) {
                $query->where('medico', 'like', '%' . $medico . '%');
            })
            ->paginate(5);

        return view('consultas.index', compact('consultas'));
    }

    /**
     * Exibe o formulário para criar uma nova consulta.
     *
     * @return \Illuminate\View\View Retorna a view para criação de consultas.
     * 
     * Decisão: Ordenar médicos por especialização para melhorar a usabilidade no formulário.
     */
    public function create()
    {
        $medicos = $this->medico->orderBy('especializacao')->get();
        return view('consultas.create-edit', ['medicos' => $medicos]);
    }

    /**
     * Armazena uma nova consulta no banco de dados.
     *
     * @param Request $request Objeto contendo os dados enviados pelo usuário.
     * @return \Illuminate\Http\RedirectResponse Redireciona com mensagem de sucesso ou erro.
     * 
     * Decisão: Separar a validação e a verificação de conflito em métodos auxiliares
     * para garantir reutilização e organização.
     */
    public function store(Request $request)
    {
        $this->validateConsulta($request);

        if ($this->verificarConflitoConsulta($request->medico, $request->dataehora)) {
            return redirect()->back()
                ->with('error', 'Já existe uma consulta marcada para este médico neste horário.')
                ->withInput();
        }

        Consulta::create($request->only(['paciente', 'medico', 'dataehora', 'descricao']));

        return redirect()->route('consulta.home')->with('success', 'Consulta agendada com sucesso!');
    }

    /**
     * Gera relatórios de consultas agrupados por paciente, médico e data.
     *
     * @return \Illuminate\View\View Retorna a view com os relatórios gerados.
     */
    public function show()
    {
        $agendamentosPorPacienteEMedico = Consulta::selectRaw('DATE(dataehora) as dia, paciente, medico, count(*) as total')
            ->groupByRaw('DATE(dataehora), paciente, medico')
            ->orderByRaw('DATE(dataehora) ASC')
            ->get();

        $agendamentosPorDia = Consulta::selectRaw('DATE(dataehora) as dia, count(*) as total')
            ->groupByRaw('DATE(dataehora)')
            ->orderByRaw('DATE(dataehora) ASC')
            ->get();

        return view('consultas.relatorio', [
            'agendamentosPorPacienteEMedico' => $agendamentosPorPacienteEMedico,
            'agendamentosPorDia' => $agendamentosPorDia,
        ]);
    }

    /**
     * Exibe o formulário para editar uma consulta.
     *
     * @param int $id ID da consulta a ser editada.
     * @return \Illuminate\View\View Retorna a view de edição com os dados carregados.
     */
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);
        $medicos = Medico::all();

        return view('consultas.create-edit', compact('consulta', 'medicos'));
    }

    /**
     * Atualiza uma consulta existente.
     *
     * @param Request $request Objeto contendo os dados enviados pelo usuário.
     * @param int $id ID da consulta a ser atualizada.
     * @return \Illuminate\Http\RedirectResponse Redireciona com mensagem de sucesso ou erro.
     * 
     * Decisão: Reutilizar os métodos de validação e verificação de conflito do store.
     */
    public function update(Request $request, $id)
    {
        $this->validateConsulta($request);

        if ($this->verificarConflitoConsulta($request->medico, $request->dataehora, $id)) {
            return redirect()->back()
                ->with('error', 'Já existe uma consulta marcada para este médico neste horário.')
                ->withInput();
        }

        $consulta = Consulta::findOrFail($id);
        $consulta->update($request->only(['paciente', 'medico', 'dataehora', 'descricao']));

        return redirect()->route('consulta.home')->with('success', 'Consulta atualizada com sucesso!');
    }

    /**
     * Remove uma consulta do banco de dados.
     *
     * @param int $id ID da consulta a ser removida.
     * @return \Illuminate\Http\RedirectResponse Redireciona com mensagem de sucesso.
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consulta.home')->with('success', 'Consulta excluída com sucesso.');
    }

    /**
     * Valida os dados enviados na requisição.
     *
     * @param Request $request Dados da requisição.
     */
    private function validateConsulta(Request $request)
    {
        $request->validate([
            'paciente' => 'required|string|min:3|max:255',
            'medico' => 'required|string',
            'dataehora' => 'required|date',
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser um texto',
            'max' => 'O campo :attribute deve conter no máximo 255 caracteres',
            'min' => 'O campo :attribute deve conter no mínimo 3 caracteres',
        ]);
    }

    /**
     * Verifica se existe conflito de consulta no mesmo horário para o mesmo médico.
     *
     * @param string $medico Nome do médico.
     * @param string $dataehora Data e hora da consulta.
     * @param int|null $ignoreId ID da consulta a ser ignorada (para edição).
     * @return bool Retorna verdadeiro se houver conflito.
     */
    private function verificarConflitoConsulta($medico, $dataehora, $ignoreId = null)
    {
        $query = Consulta::where('medico', $medico)
            ->where('dataehora', $dataehora);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
