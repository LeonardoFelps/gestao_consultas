<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Http\Requests\StoreconsultaRequest;
use App\Http\Requests\UpdateconsultaRequest;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('consultas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $medicos = ['Dr. Carlos', 'Dr. Pedro', 'Dr. Maia'];
        return view('consultas.create', ['medicos' => $medicos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recebe os dados enviados do formulário
        $data = $request->all();

        // Aqui você pode salvar os dados no banco de dados ou realizar outra lógica
        return response()->json([
            'message' => 'erro',
            'data' => $data
        ]);

        return response()->json([
            'message' => 'ok',
            'data' => $data
        ]);
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
