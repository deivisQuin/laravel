<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Empresa;
use App\LocalLineaSublineaProducto;
use App\Producto;
use App\LocalUbigeoDelivery;
use App\Local;
use App\UserLocal;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function listar() {
        $usersRolId = Auth::user()->usersRolId;

        if (Auth::user()->rol->rolNombreCorto == "VENT") {
            $aUserLocal = UserLocal::where("ULUsersId", "=", $usersRolId)->get();

            $aProducto = DB::table("local_linea_sublinea_producto")
                            ->leftJoin("producto", "local_linea_sublinea_producto.LLSPProductoId", "=", "producto.productoId")
                            ->leftJoin("local", "local_linea_sublinea_producto.LLSPLocalId", "=", "local.localId")
                            ->leftJoin("estado", "local_linea_sublinea_producto.LLSPEstadoId", "=", "estado.estadoId")
                            ->where("local.localId", "=", $aUserLocal[0]->ULLocalId)                            
                            ->get();

            return view("producto.listarProducto",compact("aProducto"));
        }
    }

    public function obtenerProducto($productoId, $localId) {
        $aProducto = DB::table('local_linea_sublinea_producto')
                        ->join('producto', 'local_linea_sublinea_producto.LLSPProductoId', '=', 'producto.productoId')
                        ->where('local_linea_sublinea_producto.LLSPEstadoId', '=', 1)
                        ->where('local_linea_sublinea_producto.LLSPProductoId', '=', $productoId)
                        ->where('local_linea_sublinea_producto.LLSPLocalId', '=', $localId)
                        ->select('producto.*', 'local_linea_sublinea_producto.LLSPPrecio')
                        ->get();

        return response()->json($aProducto[0]);
    }
    
    public function obtenerRuc($empresaRuc) {
        $oEmpresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        if ( isset($oEmpresa->empresaId) ) {
            //Se obtiene el local de la empresa
            $aLocal = Local::where("localEmpresaId", "=", $oEmpresa->empresaId)->where("localEstadoId", "=", 1)->get();
            //Se obtiene el listado de productos del local
            $aProducto = LocalLineaSublineaProducto::where("LLSPLocalId", "=", $aLocal[0]->localId)->where("LLSPEstadoId", "=", 1)->get();
            
            //Se obtiene los lugares de delivery de la empresa
            $aLocalUbigeoDelivery = LocalUbigeoDelivery::where("LULocalId", "=", $aLocal[0]->localId)->get();

            $mostrarLocales = "";

            if (count($aLocal) < 2) {
                $mostrarLocales = "style=display:none";
            }

            //Verificar Si el lcal está atendiendo
            $horaActual         = strtotime(date("H:i"));
            $localHoraApertura  = strtotime($aLocal[0]->localHoraApertura);
            $localHoraCierre    = strtotime($aLocal[0]->localHoraCierre);
            $indLocalAtendiendo = 0;

            //Hora de apertura es mayor que la hora del cierre
            if ($localHoraApertura > $localHoraCierre) {  
                if (($horaActual >= $localHoraApertura) && ($horaActual <= strtotime("23:59"))) {
                    $indLocalAtendiendo = 1;
                } elseif ($horaActual <= $localHoraCierre) {
                    $indLocalAtendiendo = 1;
                }
            } else {
                if (($localHoraApertura <= $horaActual) && ($localHoraCierre >= $horaActual)) {
                    $indLocalAtendiendo = 1;
                }
            }

            return view("iniciar", compact(["oEmpresa", "aProducto", "aLocalUbigeoDelivery", "aLocal", "mostrarLocales", "indLocalAtendiendo"]));
        } else {
            return view("empresaNoRegistrada");
        }
    }

    public function listarProductoLocal($localId) {
        //Se obtiene los datos del local
        $local = Local::findOrFail($localId);

        //Se obtiene el listado de productos del local
        $aProducto = LocalLineaSublineaProducto::where("LLSPLocalId", "=", $localId)
            ->where("LLSPEstadoId", "=", 1)
            ->orderBy('LLSPPosicion', 'Asc')->get();

        //Verificar Si el lcal está atendiendo
        $horaActual         = strtotime(date("H:i"));
        $localHoraApertura  = strtotime($local->localHoraApertura);
        $localHoraCierre    = strtotime($local->localHoraCierre);
        $indLocalAtendiendo = 0;

        //Hora de apertura es mayor que la hora del cierre
        if ($localHoraApertura > $localHoraCierre) {  
            if (($horaActual >= $localHoraApertura) && ($horaActual <= strtotime("23:59"))) {
                $indLocalAtendiendo = 1;
            } elseif ($horaActual <= $localHoraCierre) {
                $indLocalAtendiendo = 1;
            }
        } else {
            if (($localHoraApertura <= $horaActual) && ($localHoraCierre >= $horaActual)) {
                $indLocalAtendiendo = 1;
            }
        }
            
        return response()->json(view("producto.productoLocalPartial", compact("aProducto", "local", "indLocalAtendiendo"))->render());
    }

    public function validarFormularioCarrito(Request $request){
        $aEmpresa = Empresa::where([["empresaRuc", "=", $request->input("empresaRuc")]])->first();

        if(!$aEmpresa){
            return response()->json(["success" => false, "mensajeError"=>"Comercio no registrado en el Sistema"]);
        }

        if($request->input("empresaEmail") != $aEmpresa->empresaEmail) {
            return response()->json(["success" => false, "mensajeError"=>"El correo de la empresa no pertence al RUC registrado"]);
        }

        $validaciones = $request->validate([
            'monto' => 'required|numeric|min:5|max:5000',
            'producto' => 'required|between:5,250',
        ]);

        return response()->json(["success" => false, "mensajeError"=>false]);
    }
}
