<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = DB::select('CALL sp_getPeliculass()');

        if (empty($peliculas)) {
            return response()->json([
                'message' => 'No hay películas registradas',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'peliculas' => $peliculas,
            'status' => 200
        ], 200);
    }

    public function show($id)
    {
        $pelicula = DB::select('CALL sp_getPelicula(?)', [$id]);

        if (empty($pelicula)) {
            return response()->json([
                'message' => 'Película no encontrada',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'pelicula' => $pelicula[0],
            'status' => 200
        ], 200);
    }
}
