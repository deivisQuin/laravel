<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;

use App\Transaccion;
use App\Empresa;

class CorreoController extends Controller
{
    public function sendMail(Request $request){
        $empresaRuc = $request->input("empresaRuc");
        $comercioCorreo = $request->input("empresaEmail");
        $clienteCorreo = $request->input("clienteEmail");
        $monto = $request->input("monto");
        $descripcion = $request->input("descripcion");

        //Se obtienen los datos de la empresa
        $aEmpresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        //Se obtienen datos aleatorios
        $transaccionComercioPassword = rand();
        $transaccionComercioPasswordLink = str_replace("/", "(", password_hash("rasmuslerdorf", PASSWORD_DEFAULT));
        $transaccionClientePassword = rand();
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
        $transaccion->empresaId = $aEmpresa->empresaId;

        $transaccion->save();

        $transaccionId = $transaccion->transaccionId;

        //Enviamos los correos al cliente y al comercio
        $correo = new MessageReceived(
            $monto,
            $descripcion,
            $request->input("enviarCorreoTipo"),
            $request->input("_token"),
            "",
            "");

        Mail::to($comercioCorreo)
                ->cc($clienteCorreo)
                ->send($correo);

        //Se envia Correo al comercio
        $correo = new MessageReceived(
            $monto,
            $descripcion,
            "2",
            $transaccionComercioPassword,
            $transaccionComercioPasswordLink,
            $transaccionId
        );

        Mail::to($comercioCorreo)
                ->send($correo);

        //Se envia Correo al cliente
        $correo = new MessageReceived(
            $monto,
            $descripcion,
            "3",
            $transaccionClientePassword,
            $transaccionClientePasswordLink,
            $transaccionId
        );

        Mail::to($clienteCorreo)
                ->send($correo);

        return redirect()->back()->with("success", "Email enviado");
    }
}
