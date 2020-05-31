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
            $this->view('emails.message-received')->subject("Pago Libre - Anuncio de Compra");
        }
        if ($this->enviarCorreoTipo === "2") {
            $this->view('emails.message-comercio')->subject("Pago Libre - Link del Cambio de estado de Comercio");
        }
        if ($this->enviarCorreoTipo === "3") {
            $this->view('emails.message-comercio')->subject("Pago Libre - Link del Cambio de estado de Cliente");
        }
    }
}