<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    public function editarEstado($transaccionId, $passwordLink, $transaccionTipo){
        if ($transaccionTipo == 1) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionComercioPasswordLink", "=", $passwordLink]])->first();
        } elseif ($transaccionTipo == 2) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionClientePasswordLink", "=", $passwordLink]])->first();
        } else {
            return "El tipo de Transacción es Incorrecto";
        }
        
        if ( isset($aTransaccion->transaccionId) ) {
            $aTransaccion->transaccionTipo = $transaccionTipo;
        
            return view("modificarEstado", compact("aTransaccion"));
        }

        return "usted no tiene acceso a la página";
    }

    public function modificarEstado(Request $request, $transaccionId){

        $password = $request->input("contrasena");
        $transaccionTipo = $request->input("transaccionTipo");
        $transaccionCienteComercioPasswordLink = $request->input("transaccionCienteComercioPasswordLink");

        //Se obtiene los datos de la transaccion
        if ($transaccionTipo == 1) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionComercioPasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionComercioPassword", "=", $password]])->first();
        } elseif ($transaccionTipo == 2) {
            //Se verifica que e comercio haya entregado el producto y/o servicio
            $aTransaccionComercio = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionComercioEstado", "=", 2]])->first();

            if ($aTransaccionComercio) {
                $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionClientePasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionClientePassword", "=", $password]])->first();    
            } else {
                return "No puede Recibir el Producto y/o Servicio mientas que el comercio no lo haya Entregado y registrado en el sistema";    
            }
            
        } else {
            return "La transacción no existe";
        }

        if (isset($aTransaccion->transaccionId)) {
            // Se modifica el estado 
            if ($transaccionTipo == 1) {
                $update = DB::update("update transaccion set transaccionComercioEstado = 2 where transaccionId  = ?", [$transaccionId]);
            } else {
                $update = DB::update("update transaccion set transaccionClienteEstado = 2 where transaccionId  = ?", [$transaccionId]);
            }
    
            return redirect("nuevoEstado/$transaccionId/gracias");

        } else {
            return "Los datos ingresados no son los correctos";
        }
    }

    public function graciasCambioEstado($transaccionId){
        //Obtenemos los estados del pedido
        $aTransaccion = Transaccion::findOrFail($transaccionId);
        return view("nuevoEstadoGracias", compact("aTransaccion")); 
    }
    
    public function tarjetaNoProcede(){
        return view("tarjetaNoProcede");   
    }

    public function gracias(){
        return view("gracias");
    }
}
