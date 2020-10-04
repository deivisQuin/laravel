<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $monto;
    public $enviarCorreoTipo;
    public $transaccionComercioClientePassword;
    public $transaccionComercioClientePasswordLink;
    public $transaccionId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $enviarCorreoTipo, $transaccionComercioClientePassword, $transaccionComercioClientePasswordLink, $transaccionId)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->monto = $subject;
        $this->transaccionComercioClientePassword = $transaccionComercioClientePassword;
        $this->transaccionComercioClientePasswordLink = $transaccionComercioClientePasswordLink;
        $this->enviarCorreoTipo = $enviarCorreoTipo;
        $this->transaccionId = $transaccionId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->enviarCorreoTipo === "1") {
            $this->view('emails.mensajeAnuncio')->subject("Pago Libre - Informe del Pedido");
        }
        if ($this->enviarCorreoTipo === "2") {
            $this->view('emails.mensajeConfirmacion')->subject("Pago Libre - Confirmar Entrega del Pedido");
        }
        if ($this->enviarCorreoTipo === "3") {
            $this->view('emails.mensajeConfirmacion')->subject("Pago Libre - Confirmar Recibimiento del Pedido");
        }
        //para imprimir el código QR
        if ($this->enviarCorreoTipo === "4") {
            //$variable = \QrCode::size(100)->generate("www.nigmacode.com");
            //$variable = \QrCode::format("svg")->size(300)->generate("www.nigmacode.com");
            $variable = "hola";
            $this->view('emails.mensajeConfirmacionQR', compact("variable"))->subject("Pago Libre - Confirmar Recibimiento del Pedido");
        }
    }
}
