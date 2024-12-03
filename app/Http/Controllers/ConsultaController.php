<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Models\medico;
use App\Http\Requests\StoreconsultaRequest;
use App\Http\Requests\UpdateconsultaRequest;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{

    public function __construct(Medico $medico) {
        $this->medico = $medico;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Buscar todas as consultas
    $consultas = Consulta::all(); // Você pode também aplicar filtros ou ordenação aqui se necessário

    // Retornar a view passando as consultas
    return view('consultas.index', compact('consultas'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $medicos = $this->medico->orderBy('especializacao')->get();
        return view('consultas.create-edit', ['medicos' => $medicos]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
        $regras = [
            'paciente' => 'required|string|min:3|max:255',
            'medico' => 'required|string',
            'dataehora' => 'required|date',
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser um texto',
            'max' => 'O campo :attribute deve ser conter no máximo 255 caracteres',
            'min' => 'O campo :attribute deve ser conter no mínimo 3 caracteres'
        ];

        $request->validate($regras, $feedback);


         // Verificar se já existe uma consulta com o mesmo médico no mesmo horário
         $consultaExistente = Consulta::where('medico', $request->medico)
             ->where('dataehora', $request->dataehora)
             ->first(); // Retorna o primeiro registro encontrado
     
         // Se uma consulta já existir, retornar erro ou mensagem
         if ($consultaExistente) {
             return redirect()->back()->with('error', 'Já existe uma consulta marcada para este médico neste horário.')->withInput();
         }
     
         // Caso não exista consulta, cria uma nova consulta
         $consulta = new Consulta();
         $consulta->paciente = $request->paciente;
         $consulta->medico = $request->medico;
         $consulta->dataehora = $request->dataehora;
         $consulta->descricao = $request->descricao;
     
         // Salvar no banco de dados
         $consulta->save();
     
         // Retornar uma resposta de sucesso
         return redirect()->route('consulta.home')->with('success', 'Consulta agendada com sucesso!');
     }
     


    /**
     * Display the specified resource.
     */
    public function show(consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consulta = new Consulta();
        // Buscar a consulta no banco
        $consulta = Consulta::findOrFail($id);

        // Buscar os médicos (ou outros dados necessários)
        $medicos = Medico::all();

        // Retornar a view com os dados
        return view('consultas.create-edit', compact('consulta', 'medicos'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar os dados
        $regras = [
            'paciente' => 'required|string|min:3|max:255',
            'medico' => 'required|string',
            'dataehora' => 'required|date',
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser um texto',
            'max' => 'O campo :attribute deve ser conter no máximo 255 caracteres',
            'min' => 'O campo :attribute deve ser conter no mínimo 3 caracteres'
        ];

        $validated = $request->validate($regras, $feedback);

        // Verificar se já existe uma consulta com o mesmo médico no mesmo horário
        $consultaExistente = Consulta::where('medico', $request->medico)
        ->where('dataehora', $request->dataehora)
        ->first(); // Retorna o primeiro registro encontrado

        // Se uma consulta já existir, retornar erro ou mensagem
        if ($consultaExistente) {
            return redirect()->back()->with('error', 'Já existe uma consulta marcada para este médico neste horário.')->withInput();
        }

        // Atualizar a consulta no banco
        $consulta = Consulta::findOrFail($id);
        $consulta->update($validated);

        // Redirecionar ou retornar a view com sucesso
        return redirect()->route('consulta.edit', $consulta->id)
                        ->with('success', 'Consulta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id); // Encontra a consulta pelo ID
        $consulta->delete(); // Deleta a consulta
    
        // Redireciona para a lista de consultas com uma mensagem de sucesso
        return redirect()->route('consultas.index')->with('success', 'Consulta excluída com sucesso!');
    }
}
