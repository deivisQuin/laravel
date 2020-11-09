<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Salsa;
use App\UserLocal;

class SalsaController extends Controller
{
    public function listarJson($localId) {
        $aSalsa = Salsa::where("salsaLocalId", "=", $localId)->get();
        
        return response()->json($aSalsa);
    }

    public function listar() {
        $usersRolId = Auth::user()->usersRolId;

        if (Auth::user()->rol->rolNombreCorto == "VENT") {
            $aUserLocal = UserLocal::where("ULUsersId", "=", $usersRolId)->get();

            $aSalsa = Salsa::where("salsaLocalId", "=", $aUserLocal[0]->ULLocalId)->get();

            return view("salsa.listarSalsa",compact("aSalsa"));
        }
    }

    public function modificar(Request $request) {
        $salsaId       = $request->input("salsaId");
        $estadoIdNuevo = $request->input("estadoIdNuevo");

        $oSalsa = Salsa::find($salsaId);
        
        $oSalsa->salsaEstadoId = $estadoIdNuevo;

        $oSalsa->save();

        return response()->json("true");
    }
}
