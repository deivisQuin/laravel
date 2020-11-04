<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocalLineaSublineaProducto;

class LocalLineaSublineaProductoController extends Controller
{
    public function modificar(Request $request) {
        $LLSPId        = $request->input("LLSPId");
        $estadoIdNuevo = $request->input("estadoIdNuevo");

        $oLLSP = LocalLineaSublineaProducto::find($LLSPId);
        
        $oLLSP->LLSPEstadoId = $estadoIdNuevo;

        $oLLSP->save();

        return response()->json("true");
    }
}
