<?php

use App\Http\Controllers\CineController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

Route::controller(CineController::class)->prefix('cines')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::get('/{id}/tarifas', 'CineTarifas');
});

Route::controller(PeliculaController::class)->prefix('peliculas')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::controller(CineController::class)->group(function () {
    Route::prefix('participacion')->group(function () {
        Route::get('/{tipo}', 'getParticipacion');
        Route::get('/{tipo}/{departamento}', 'getParticipacion');
        Route::get('/{tipo}/{departamento}/{provincia}', 'getParticipacion');
    });

    Route::prefix('actas')->group(function () {
        Route::get('/ubigeo/{pais}', 'getActasUbigeo');
        Route::get('/ubigeo/{pais}/{departamento}', 'getActasUbigeo');
        Route::get('/ubigeo/{pais}/{departamento}/{provincia}', 'getActasUbigeo');
        Route::get('/ubigeo/{pais}/{departamento}/{provincia}/{distrito}', 'getActasUbigeo');
        Route::get('/ubigeo/{pais}/{departamento}/{provincia}/{distrito}/{local}', 'getActasUbigeo');
        Route::get('/ubigeo/{pais}/{departamento}/{provincia}/{distrito}/{local}/{grupo}', 'getActasUbigeo');

        Route::get('/numero/{numero}', 'getActasNumero');
    });
});
