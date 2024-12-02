<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

//Route::get('/consultas', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consultas');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
