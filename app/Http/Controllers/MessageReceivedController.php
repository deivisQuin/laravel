<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;

use App\Transaccion;
class MessageReceivedController extends Controller
{
    public function sendMail(Request $request){

        //Validaciones
        $validar = $request->validate([
            "email" => "required|max:50|email",
            "email2" => "required|max:50|email",
            "subject" => "required|numeric",
            "content" => "required"
        ]);

        //Se obtienen datos aleatorios
        $transaccionComercioPassword = rand();
        $transaccionComercioPasswordLink = str_replace("/", "(", password_hash("rasmuslerdorf", PASSWORD_DEFAULT));
        $transaccionClientePassword = rand();
        $transaccionClientePasswordLink = str_replace("/", ")", password_hash("rasmuslerdorf", PASSWORD_DEFAULT));

        //creamos el registro de la transaccion
        $transaccion = new Transaccion;

        $transaccion->transaccionComercioCorreo = $request->input("email");
        $transaccion->transaccionComercioPassword = $transaccionComercioPassword;
        $transaccion->transaccionComercioPasswordLink = $transaccionComercioPasswordLink;
        $transaccion->transaccionClienteCorreo = $request->input("email2");
        $transaccion->transaccionClientePassword = $transaccionClientePassword;
        $transaccion->transaccionClientePasswordLink = $transaccionClientePasswordLink;
        $transaccion->transaccionMonto = $request->input("subject");
        $transaccion->transaccionDescripcion = $request->input("content");
        $transaccion->transaccionEstado = "1";
        $transaccion->transaccionUsuarioCrea = "1";
        $transaccion->transaccionFechaCrea = date("Y-m-d H:m:s");
        $transaccion->transaccionComercioEstado = "1";
        $transaccion->transaccionClienteEstado = "1";

        $transaccion->save();

        $transaccionId = $transaccion->transaccionId;

        //Enviamos los correos
    	$messageReceived = new MessageReceived(
    		$request->input("subject"),
    		$request->input("content"),
            $request->input("enviarCorreoTipo"),
            $request->input("_token"),
            "",
            "",
    	);

    	Mail::to($request->input("email"))
    			->cc($request->input("email2"))
    			->send($messageReceived);

        //Segundo Correo
        $messageReceived = new MessageReceived(
            $request->input("subject"),
            $request->input("content"),
            "2",
            $transaccionComercioPassword,
            $transaccionComercioPasswordLink,
            $transaccionId
        );

        Mail::to($request->input("email"))
                ->send($messageReceived);

        //Tercer Correo
        $messageReceived = new MessageReceived(
            $request->input("subject"),
            $request->input("content"),
            "3",
            $transaccionClientePassword,
            $transaccionClientePasswordLink,
            $transaccionId
        );

        Mail::to($request->input("email2"))
                ->send($messageReceived);

    	return redirect()->back()->with("success", "Email enviado");
    	//return response()->json();
    }
}
