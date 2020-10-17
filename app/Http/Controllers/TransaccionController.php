<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use App\Empresa;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Generator;

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
        $aTransaccion = Transaccion::where("transaccionEmpresaId", "=", $empresaId)
                        ->where("transaccionFechaCrea", "like", "$transaccionFechaCrea%")
                        ->orderBy("transaccionId", "desc")
                        ->paginate(10);
        return response()->json(view("empresaTransaccion.empresaTransaccion", compact("aTransaccion"))->render());
    }

    public function obtener($transaccionId) {
        $aTransaccion = Transaccion::where("transaccionId" , "=", $transaccionId)->firstOrFail();

        return response()->json(view("empresaTransaccion.empresaTransaccionDetalle",compact("aTransaccion"))->render());
    }

    public function registrar(Request $request) {
        $empresaRuc     = $request->input("empresaRuc");
        $comercioCorreo = $request->input("empresaEmail");
        $clienteCorreo  = $request->input("clienteEmail");
        $monto          = $request->input("monto");
        $descripcion    = $request->input("descripcion");
        
        //Se obtienen los datos de la empresa
        $aEmpresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        //Se obtienen datos aleatorios
        $transaccionComercioPassword = rand(1001, 9999);
        $transaccionComercioPasswordLink = str_replace("/", "(", password_hash("rasmuslerdorf", PASSWORD_DEFAULT));
        $transaccionClientePassword = rand(1001, 9999);
        $transaccionClientePasswordLink = str_replace("/", ")", password_hash("rasmuslerdorf", PASSWORD_DEFAULT));

        //creamos el registro de la transaccion
        $transaccion = new Transaccion;

        $transaccion->transaccionComercioCorreo = $comercioCorreo;
        $transaccion->transaccionComercioPassword = $transaccionComercioPassword;
        $transaccion->transaccionComercioPasswordLink = $transaccionComercioPasswordLink;
        $transaccion->transaccionComercioEstado = "1";
        $transaccion->transaccionClienteCorreo = $clienteCorreo;
        $transaccion->transaccionClientePassword = $transaccionClientePassword;
        $transaccion->transaccionClientePasswordLink = $transaccionClientePasswordLink;
        $transaccion->transaccionClienteEstado = "1";
        $transaccion->transaccionMonto = $monto;
        $transaccion->transaccionDescripcion = $descripcion;
        $transaccion->transaccionEstadoId = "1";
        $transaccion->transaccionUsuarioCrea = "1";
        $transaccion->transaccionFechaCrea = date("Y-m-d H:m:s");
        $transaccion->transaccionPasarelaPedidoId = $request->input("transaccionPasarelaPedidoId");
        $transaccion->transaccionPasarelaToken = $request->input("transaccionPasarelaToken");
        $transaccion->transaccionPasarelaMonedaCodigo = $request->input("transaccionPasarelaMonedaCodigo");
        $transaccion->transaccionPasarelaBancoNombre = $request->input("transaccionPasarelaBancoNombre");
        $transaccion->transaccionPasarelaBancoPaisNombre = $request->input("transaccionPasarelaBancoPaisNombre");
        $transaccion->transaccionPasarelaBancoPaisCodigo = $request->input("transaccionPasarelaBancoPaisCodigo");
        $transaccion->transaccionPasarelaTarjetaMarca = $request->input("transaccionPasarelaTarjetaMarca");
        $transaccion->transaccionPasarelaTarjetaTipo = $request->input("transaccionPasarelaTarjetaTipo") ? $request->input("transaccionPasarelaTarjetaTipo") : "MC";
        $transaccion->transaccionPasarelaTarjetaCategoria = $request->input("transaccionPasarelaTarjetaCategoria");
        $transaccion->transaccionPasarelaTarjetaNumero = $request->input("transaccionPasarelaTarjetaNumero");
        $transaccion->transaccionPasarelaDispositivoIp = $request->input("transaccionPasarelaDispositivoIp");
        $transaccion->transaccionPasarelaCodigoAutorizacion = $request->input("transaccionPasarelaCodigoAutorizacion");
        $transaccion->transaccionPasarelaCodigoReferencia = $request->input("transaccionPasarelaCodigoReferencia");
        $transaccion->transaccionPasarelaCodigoRespuesta = $request->input("transaccionPasarelaCodigoRespuesta");
        $transaccion->transaccionPasarelaComision = $request->input("transaccionPasarelaComision")/100;
        $transaccion->transaccionPasarelaIgv = $request->input("transaccionPasarelaIgv")/100;
        $transaccion->transaccionPasarelaMontoDepositar = $request->input("transaccionPasarelaMontoDepositar")/100;
        $transaccion->transaccionPasarelaComisionFija = $request->input("transaccionPasarelaComisionFija")/100;
        $transaccion->transaccionPasarelaComisionFijaIgv = $request->input("transaccionPasarelaComisionFijaIgv")/100;
        $transaccion->transaccionComisionComercio = $request->input("transaccionComisionComercio")/100;
        $transaccion->transaccionComercioMontoDepositar = $request->input("transaccionComercioMontoDepositar")/100;
        $transaccion->transaccionEmpresaId = $aEmpresa->empresaId;
        $transaccion->transaccionOrdenId = $request->input("ordenId");

        $transaccion->save();

        $transaccionId = $transaccion->transaccionId;

        $respuesta = (new CorreoController)->enviarCorreo($transaccionId);

        return redirect()->back()->with("success", "Email enviado");
    }

    //Eliminar prueba de codigo QR
    public function graciasQR(Request $request){
        $qrCode = new Generator;
        //$imagen = $qrCode->format('png')->merge('https://image.flaticon.com/icons/png/512/838/838608.png', .3, true)->size(200)->generate("hola");
        //return view("emails.mensajeConfirmacionQR",compact("imagen"));
        $imagen = \QrCode::format("png")->size(200)->generate('https://comparadordeventas.com/pagolibre/public/nuevoEstado/13/$2y$10$TvsMCB0tPCqq8OUmVfMAc.EBc7gK0S88AQiCSiiEcYamlz93VXLFe/1', '../public/qrcodes/15.png');

        return view("emails.mensajeConfirmacionQR",compact("imagen"));
    }
}
