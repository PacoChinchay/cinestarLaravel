<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CineController extends Controller
{
    public function index()
    {
        $cines = DB::select('CALL sp_getCines()');

        if (empty($cines)) {
            return response()->json([
                'message' => 'No hay cines registrados',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'cines' => $cines,
            'status' => 200
        ], 200);
    }

    public function show($id)
    {
        $cine = DB::select('CALL sp_getCine(?)', [$id]);

        if (empty($cine)) {
            return response()->json([
                'message' => 'Cine no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'cine' => $cine[0],
            'status' => 200
        ], 200);
    }

    public function CineTarifas($id)
    {
        $cine = DB::Select('call sp_getCineTarifas(?)', [$id]);
        if (!$cine) {
            return response()->json(['message' => 'No se encontraron Tarifas para este cine'], 404);
        }
        return response()->json($cine);
    }
}
