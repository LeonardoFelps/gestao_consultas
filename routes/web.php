<?php

use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\ConsultaController::class, 'index'])->name('home');
Route::get('/create', [App\Http\Controllers\ConsultaController::class, 'create'])->name('create');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
