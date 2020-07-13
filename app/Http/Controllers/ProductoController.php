<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\EmpresaLineaSublineaProducto;
use App\Producto;

class ProductoController extends Controller
{
    public function obtenerProducto($productoId){
        $aProducto = Producto::where("productoId", "=", $productoId)->firstOrFail();
        return response()->json($aProducto);
    }
    public function obtenerRuc($empresaRuc){
        $aEmpresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        if ( isset($aEmpresa->empresaId) ) {   
            $aProducto = EmpresaLineaSublineaProducto::where("ELSPEmpresaId", "=", 1)->paginate(10);
            return view("iniciar", compact(["aEmpresa", "aProducto"]));
        } else {
            return view("empresaNoRegistrada", compact("aEmpresa"));
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
