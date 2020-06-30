<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Empresa;
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

        return "Usted no tiene acceso a la página";
    }

    public function modificarEstado(Request $request){
        $password = $request->input("contrasena");
        $transaccionTipo = $request->input("transaccionTipo");
        $transaccionCienteComercioPasswordLink = $request->input("transaccionCienteComercioPasswordLink");
        $transaccionId = $request->input("transaccionId");

        //Si no hay contraseña
        if (!isset($password)) {
            return "Debe ingresar una contraseña";
        }

        if (!isset($transaccionTipo) || ($transaccionTipo >= 3)) {
            return "La transacción no existe";
        }

        if (!isset($transaccionCienteComercioPasswordLink)) {
            return "La ruta de la transacción es incorrecta";
        }

        if (!isset($transaccionId)) {
            return "Debe de ingresar la transacción";
        }

        //Se obtiene los datos de la transaccion
        if ($transaccionTipo == 1) {
            //se actualiza el estado del comercio
            $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionComercioPasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionComercioPassword", "=", $password]])->first();
        } elseif ($transaccionTipo == 2) {
            //Se verifica que e comercio haya entregado el producto y/o servicio
            $aTransaccionComercio = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionComercioEstado", "=", 2]])->first();

            if ($aTransaccionComercio) {
                //Se actualiza el estado del cliente
                $aTransaccion = Transaccion::where([["transaccionId", "=", $transaccionId],["transaccionClientePasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionClientePassword", "=", $password]])->first();    
            } else {
                return "No puede Recibir el Producto y/o Servicio mientas que el comercio no lo haya Entregado y registrado en el sistema";    
            }   
        }

        if (!isset($aTransaccion->transaccionId)) {
            return "No se ha encontrado la transacción para los datos ingresados. Verifique los datos nuevamente.";
        }

        // Se modifica el estado 
        if ($transaccionTipo == 1) {
            $update = DB::update("update transaccion set transaccionComercioEstado = 2 where transaccionId  = ?", [$transaccionId]);
        } else {
            $update = DB::update("update transaccion set transaccionClienteEstado = 2 where transaccionId  = ?", [$transaccionId]);
        }

        if ($update == 0) {
            return "No se ha modificado el estado del pedido";
        }

        return redirect("gracias/graciasCambioEstado/$transaccionId/$transaccionTipo");
    }

    public function graciasCambioEstado($transaccionId, $transaccionTipo){
        //Obtenemos los estados del pedido
        $aTransaccion = Transaccion::findOrFail($transaccionId);
        $aTransaccion->transaccionTipo = $transaccionTipo;
        return view("nuevoEstadoGracias", compact("aTransaccion")); 
    }

    public function tarjetaNoProcede($mensajeUsuario = null){
        return view("tarjetaNoProcede",compact("mensajeUsuario"));   
    }

    public function gracias(){
        return view("gracias");
    }

    public function ventasEmpresa(Request $request) {
        $empresaId = $request->all()["empresaId"];
        $transaccionFechaCrea = $request->all()["transaccionFechaCrea"];
        
        //Se obtiene los datos de la empresa
        $aEmpresa = Empresa::where("empresaId", "=", $empresaId)->get();

        //Se obtiene las ventas de la empresa
        $aTransaccion = Transaccion::where("empresaId", "=", $empresaId)
                        ->where("transaccionFechaCrea", "like", "$transaccionFechaCrea%")
                        ->get();
        return view("empresaTransaccion.empresaTransaccion", compact("aTransaccion"));
        
    }
}
