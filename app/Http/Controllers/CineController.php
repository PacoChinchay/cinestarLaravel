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

    public function getParticipacion($tipo, $departamento = null, $provincia = null)
    {
        $bDPD = $tipo == "Nacional" || $tipo == "Extranjero";

        if ($departamento === null) {
            $rango = $tipo == "Nacional" ? [1, 25] : [26, 30];
            $result = DB::select('CALL sp_getVotos(?, ?)', $rango);
        } elseif ($provincia === null) {
            if (!$bDPD) {
                return response()->json([
                    'message' => 'Parámetros inválidos',
                    'status' => 400
                ], 400);
            }
            $result = DB::select('CALL sp_getVotosDepartamento(?)', [$departamento]);
        } else {
            if (!$bDPD || !$this->isDPD($departamento, "Departamento")) {
                return response()->json([
                    'message' => 'Parámetros inválidos',
                    'status' => 400
                ], 400);
            }
            $result = DB::select('CALL sp_getVotosProvincia(?)', [$provincia]);
        }

        return response()->json([
            'data' => $result,
            'status' => 200
        ], 200);
    }

    public function getActasUbigeo($pais, $departamento = null, $provincia = null, $distrito = null, $local = null, $grupo = null)
    {
        $parametros = func_get_args();
        $longitud = count(array_filter($parametros, function ($value) {
            return $value !== null;
        }));

        switch ($longitud) {
            case 1:
                if ($pais == "Peru") {
                    $result = DB::select('CALL sp_getDepartamentos(1,25)');
                } else {
                    $result = DB::select('CALL sp_getDepartamentos(26,30)');
                }
                break;
            case 2:
                $result = DB::select('CALL sp_getProvinciasByDepartamento(?)', [$departamento]);
                break;
            case 3:
                $result = DB::select('CALL sp_getDistritosByProvincia(?)', [$provincia]);
                break;
            case 4:
                $result = DB::select('CALL sp_getLocalesVotacionByDistrito(?, ?)', [$provincia, $distrito]);
                break;
            case 5:
                $result = DB::select('CALL sp_getGruposVotacionByProvinciaDistritoLocal(?, ?, ?)', [$provincia, $distrito, $local]);
                break;
            case 6:
                $result = DB::select('CALL sp_getGrupoVotacionByProvinciaDistritoLocalGrupo(?, ?, ?, ?, ?)', [$departamento, $provincia, $distrito, $local, $grupo]);
                break;
            default:
                return response()->json([
                    'message' => 'Parámetros insuficientes',
                    'status' => 400
                ], 400);
        }

        return response()->json([
            'data' => $result,
            'status' => 200
        ], 200);
    }

    public function getActasNumero($numero)
    {
        $result = DB::select('CALL sp_getGrupoVotacion(?)', [$numero]);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron resultados',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $result,
            'status' => 200
        ], 200);
    }

    private function isDPD($detalle, $DPD)
    {
        if ($DPD == "Departamento") {
            $result = DB::select('CALL sp_isDepartamento(?)', [$detalle]);
        } else if ($DPD == "Provincia") {
            $result = DB::select('CALL sp_isProvincia(?)', [$detalle]);
        }

        return !empty($result) && $result[0][0] == 1;
    }
}
