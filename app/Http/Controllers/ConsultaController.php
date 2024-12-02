<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Http\Requests\StoreconsultaRequest;
use App\Http\Requests\UpdateconsultaRequest;

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
        return view('consultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreconsultaRequest $request)
    {
        //
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
