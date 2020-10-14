<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EmpresaUbigeo;
use App\Orden;
use App\OrdenDetalle;

class OrdenController extends Controller
{
    public function crear(Request $request) {
        $aProducto = json_decode($request->input("aProducto"));
        $delivery = $request->input("delivery");
        $telefonoDelivery = $request->input("telefonoDelivery");
        $empresaUbigeoId = $request->input("empresaUbigeoId");
        $comentario = $request->input("comentario");
        
        //Se obtienen los datos de la empresaUbigeo
        if ((isset($empresaUbigeoId)) && ($empresaUbigeoId > 0)) {
            $aEmpresaUbigeo = EmpresaUbigeo::findOrFail($empresaUbigeoId);
            $empresaUbigeoId = $aEmpresaUbigeo->EUId;
            
            if (!$empresaUbigeoId) {
                return response()->json(["success" => false, "mensaje"=>"NO existe el distrito elegido"]);
            }
        }
        
        //creamos el registro de la transaccion
        $orden = new Orden;

        $orden->ordenDelivery = $delivery;
        $orden->ordenTelefono = $telefonoDelivery;
        $orden->ordenEUId = $empresaUbigeoId;
        $orden->ordenComentario = $comentario;
        $orden->ordenEstadoId = 1;
        $orden->ordenFechaCrea = date("Y-m-d H:m:s");

        $orden->save();
        $ordenId  = $orden->ordenId;

        //Se registra el detalle de la orden
        foreach ($aProducto as $producto) {
            $ordenDetalle = new OrdenDetalle;

            $ordenDetalle->ODOrdenId = $ordenId;
            $ordenDetalle->ODProductoId = $producto->id;
            $ordenDetalle->ODCantidad = $producto->cantidad;

            $ordenDetalle->save();
        }

        return response()->json(["success" => true, "mensaje"=>$ordenId]);
    }


}
