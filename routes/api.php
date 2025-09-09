<?php

use App\Http\Controllers\CineController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::controller(CineController::class)->prefix('cines')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::controller(PeliculaController::class)->prefix('peliculas')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});
