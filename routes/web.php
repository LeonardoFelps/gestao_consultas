<?php

use Illuminate\Support\Facades\Route;

// Rota para exibir a página inicial com a lista de consultas.
// O método `index` do `ConsultaController` será chamado.
// Nome da rota: `consulta.home`.
Route::get('/', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consulta.home');

// Rota para exibir um relatório específico de consultas.
// O método `show` do `ConsultaController` será chamado.
// Nome da rota: `consulta.relatorios`.
Route::get('/consulta/relatorio', [App\Http\Controllers\ConsultaController::class, 'show'])->name('consulta.relatorios');

// Rota para exibir o formulário de criação de uma nova consulta.
// O método `create` do `ConsultaController` será chamado.
// Nome da rota: `consulta.create`.
Route::get('/consulta/create', [App\Http\Controllers\ConsultaController::class, 'create'])->name('consulta.create');

// Rota para armazenar os dados de uma nova consulta no banco de dados.
// O método `store` do `ConsultaController` será chamado com uma requisição POST.
// Nome da rota: `consulta.store`.
Route::post('/consulta/store', [App\Http\Controllers\ConsultaController::class, 'store'])->name('consulta.store');

// Rota para exibir o formulário de edição de uma consulta específica.
// O método `edit` do `ConsultaController` será chamado, passando o `id` da consulta.
// Nome da rota: `consulta.edit`.
Route::get('/consulta/{id}/edit', [App\Http\Controllers\ConsultaController::class, 'edit'])->name('consulta.edit');

// Rota para atualizar os dados de uma consulta específica no banco de dados.
// O método `update` do `ConsultaController` será chamado com uma requisição PUT.
// Nome da rota: `consulta.update`.
Route::put('/consulta/{id}', [App\Http\Controllers\ConsultaController::class, 'update'])->name('consulta.update');

// Rota para excluir uma consulta específica do banco de dados.
// O método `destroy` do `ConsultaController` será chamado com uma requisição DELETE.
// Nome da rota: `consulta.destroy`.
Route::delete('/consulta/delete/{id}', [App\Http\Controllers\ConsultaController::class, 'destroy'])->name('consulta.destroy');
