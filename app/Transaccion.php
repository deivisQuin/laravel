<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
	protected $table = "transaccion";
    protected $primaryKey = "transaccionId";
    protected $fillable = ["transaccionComercioCorreo", "transaccionComercioPassword", "transaccionComercioPasswordLink", "transaccionComercioEstado", "transaccionComercioFechaModifica", "transaccionClienteCorreo", "transaccionClientePassword", "transaccionClientePasswordLink", "transaccionClienteEstado", "transaccionClienteFechaModifica", "transaccionMonto", "transaccionDescripcion", "transaccionEstadoId", "transaccionUsuarioCrea", "transaccionFechaCrea", "transaccionPasarelaPedidoId", "transaccionPasarelaToken", "transaccionPasarelaMonedaCodigo", "transaccionPasarelaBancoNombre", "transaccionPasarelaBancoPaisNombre", "transaccionPasarelaBancoPaisCodigo", "transaccionPasarelaTarjetaMarca", "transaccionPasarelaTarjetaTipo", "transaccionPasarelaTarjetaCategoria", "transaccionPasarelaTarjetaNumero", "transaccionPasarelaDispositivoIp", "transaccionPasarelaCodigoAutorizacion", "transaccionPasarelaCodigoReferencia", "transaccionPasarelaCodigoRespuesta", "transaccionPasarelaComision", "transaccionPasarelaIgv", "transaccionPasarelaMontoDepositar", "empresaId"];
    
    public $timestamps = false;
}
