<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ListadoController;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Envíos
Route::get('/envios/create', [EnvioController::class, 'create'])->name('envios.create');
Route::post('/envios', [EnvioController::class, 'store'])->name('envios.store');
Route::get('/envios', [EnvioController::class, 'index'])->name('envios.index');
Route::get('/envios/{id}/etiqueta', [EnvioController::class, 'etiqueta'])->name('envios.etiqueta');

// Listados
Route::get('/listados/create', [ListadoController::class, 'create'])->name('listados.create');
Route::post('/listados', [ListadoController::class, 'store'])->name('listados.store');
Route::get('/listados', [ListadoController::class, 'index'])->name('listados.index');
Route::get('/listados/{id}/descargar', [ListadoController::class, 'descargar'])->name('listados.descargar');
