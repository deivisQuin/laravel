<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Generator;

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
    public $transaccionComercioPasswordLink;
    public $oOrden;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $aOrdenDetalle, $enviarCorreoTipo, $transaccionComercioClientePassword, $transaccionComercioClientePasswordLink, 
                                $transaccionId, $transaccionComercioPasswordLink, $oOrden)
    {
        $this->subject = $subject;
        $this->content = $aOrdenDetalle;
        $this->monto = $subject;
        $this->transaccionComercioClientePassword = $transaccionComercioClientePassword;
        $this->transaccionComercioClientePasswordLink = $transaccionComercioClientePasswordLink;
        $this->enviarCorreoTipo = $enviarCorreoTipo;
        $this->transaccionId = $transaccionId;
        $this->transaccionComercioPasswordLink = $transaccionComercioPasswordLink;
        $this->oOrden = $oOrden;
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
            //$qrCode = new Generator;
            //$imagen = $qrCode->format('png')->merge('https://image.flaticon.com/icons/png/512/838/838608.png', .3, true)->size(200)->generate("hola");
            $imagenQR = \QrCode::format("png")->size(200)->generate('https://comparadordeventas.com/pagolibre/public/nuevoEstado/'.$this->transaccionId.'/'.$this->transaccionComercioPasswordLink.'/1', '../public/qrcodes/'.$this->transaccionId.'.png');
            $imagen = $this->transaccionId;
            $this->view('emails.mensajeConfirmacionQR', compact("imagen"))->subject("Pago Libre - Confirmar Recibimiento del Pedido");
        }
    }
}
