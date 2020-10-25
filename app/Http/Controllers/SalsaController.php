<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Salsa;

class SalsaController extends Controller
{
    public function listar($localId) {
        $aSalsa = Salsa::where("salsaEstadoId", "=", 1)->where("salsaLocalId", "=", $localId)->get();
        
        return response()->json($aSalsa);
    }
}
