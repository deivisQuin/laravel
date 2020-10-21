<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\LocalLineaSublineaProducto;
use App\Producto;
use App\LocalUbigeoDelivery;
use App\Local;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function obtenerProducto($productoId, $localId){
        //$aProducto = Producto::where("productoId", "=", $productoId)->firstOrFail();
        $aProducto = DB::table('local_linea_sublinea_producto')
            ->join('producto', 'local_linea_sublinea_producto.LLSPProductoId', '=', 'producto.productoId')
            ->where('local_linea_sublinea_producto.LLSPestadoId', '=', 1)
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
            $aLocal = Local::where("LocalEmpresaId", "=", $oEmpresa->empresaId)->get();
            //Se obtiene el listado de productos del local
            $aProducto = LocalLineaSublineaProducto::where("LLSPLocalId", "=", $aLocal[0]->localId)->get();
            
            //Se obtiene los lugares de delivery de la empresa
            $aLocalUbigeoDelivery = LocalUbigeoDelivery::where("LULocalId", "=", $aLocal[0]->localId)->get();

            $mostrarLocales = "";

            if (count($aLocal) < 2) {
                $mostrarLocales = "style=display:none";
            }

            return view("iniciar", compact(["oEmpresa", "aProducto", "aLocalUbigeoDelivery", "aLocal", "mostrarLocales"]));
        } else {
            return view("empresaNoRegistrada");
        }
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
