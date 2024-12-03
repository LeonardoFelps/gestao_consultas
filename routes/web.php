<?php

use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/consulta', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consulta.home');
Route::get('/consulta/create', [App\Http\Controllers\ConsultaController::class, 'create'])->name('consulta.create');
Route::post('/consulta/store', [App\Http\Controllers\ConsultaController::class, 'store'])->name('consulta.store');
Route::get('/consulta/{id}/edit', [App\Http\Controllers\ConsultaController::class, 'edit'])->name('consulta.edit');
Route::put('/consulta/{id}', [App\Http\Controllers\ConsultaController::class, 'update'])->name('consulta.update');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
