<?php

use App\Http\Controllers\CineController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::get('/students', [studentController::class, 'index']);

Route::get('/students/{id}', [studentController::class, 'show']);

Route::post('/students', [studentController::class, 'store']);

Route::put('/students/{id}', [studentController::class, 'update']);

Route::delete('/students/{id}',[studentController::class, 'destroy']);


Route::get('/cines', [CineController::class, 'index']);
Route::get('/cines/{id}', [CineController::class, 'show']);

Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);