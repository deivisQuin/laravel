<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Local;
use App\UserLocal;

class LocalController extends Controller
{
    public function listar($empresaId) {
        $usersId = Auth::user()->id;

        //Se obtiene los locales asignado a la empresa
        $aLocal = Local::where("localEmpresaId", "=", $empresaId)->get();

        if (count($aLocal) < 1) {
            $respuesta["error"]     = "error";
            $respuesta["mensaje"] = "NO hay locales asignado a la empresa";
            
            return $respuesta;
        }

        $aLocalId = [];

        foreach ($aLocal as $local) {
            $aLocalId[] = $local->localId; 
        }

        $aUserLocal = UserLocal::where("ULUsersId", "=", $usersId)->whereIn("ULLocalId", $aLocalId)->get();

        if (count($aUserLocal) < 1) {
            $respuesta["error"]     = "error";
            $respuesta["mensaje"] = "NO hay locales asignado a la empresa";
            
            return $respuesta;
        }

        $a_local = [];
        $i       = 0;
        
        foreach ($aUserLocal as $userLocal) {
            $a_local[$i]["localId"] = $userLocal->local->localId;
            $a_local[$i]["localNombre"] = $userLocal->local->localNombre;
            $i++;
        }
        
        return $a_local;

        /*foreach ($aUserLocal as $userLocal) {
            dd($userLocal["ULLocalId"]);
        }*/

       /*if (Auth::user()->rol->rolNombreCorto == "VENT") {
            $aUserLocal = UserLocal::where("ULUsersId", "=", $usersRolId)->get();

            $aProducto = DB::table("local_linea_sublinea_producto")
                            ->leftJoin("producto", "local_linea_sublinea_producto.LLSPProductoId", "=", "producto.productoId")
                            ->leftJoin("local", "local_linea_sublinea_producto.LLSPLocalId", "=", "local.localId")
                            ->leftJoin("estado", "local_linea_sublinea_producto.LLSPEstadoId", "=", "estado.estadoId")
                            ->where("local.localId", "=", $aUserLocal[0]->ULLocalId)                            
                            ->get();

            return view("producto.listarProducto",compact("aProducto"));
        }*/
    }
}
