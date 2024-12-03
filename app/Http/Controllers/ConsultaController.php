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
        return view('consultas.create', ['medicos' => $medicos]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Verificar se já existe uma consulta com o mesmo médico no mesmo horário
         $consultaExistente = Consulta::where('medico', $request->medico)
             ->where('dataehora', $request->dataehora)
             ->first(); // Retorna o primeiro registro encontrado
     
         // Se uma consulta já existir, retornar erro ou mensagem
         if ($consultaExistente) {
             return redirect()->back()->with('error', 'Já existe uma consulta marcada para este médico neste horário.');
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
         return redirect()->route('home')->with('success', 'Consulta agendada com sucesso!');
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
    public function edit(consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateconsultaRequest $request, consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(consulta $consulta)
    {
        //
    }
}
