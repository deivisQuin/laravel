<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
	protected $table = "transaccion";
    protected $primaryKey = "transaccionId";
    protected $fillable = ["transaccionComercioCorreo", "transaccionComercioPassword", "transaccionComercioPasswordLink", 
                            "transaccionComercioEstado", "transaccionComercioFechaModifica", "transaccionClienteCorreo", 
                            "transaccionClientePassword", "transaccionClientePasswordLink", "transaccionClienteEstado", 
                            "transaccionClienteFechaModifica", "transaccionMonto", "transaccionDescripcion", "transaccionEstadoId", 
                            "transaccionUsuarioCrea", "transaccionFechaCrea", "transaccionPasarelaPedidoId", 
                            "transaccionPasarelaToken", "transaccionPasarelaMonedaCodigo", "transaccionPasarelaBancoNombre", 
                            "transaccionPasarelaBancoPaisNombre", "transaccionPasarelaBancoPaisCodigo", 
                            "transaccionPasarelaTarjetaMarca", "transaccionPasarelaTarjetaTipo", "transaccionPasarelaTarjetaCategoria", 
                            "transaccionPasarelaTarjetaNumero", "transaccionPasarelaDispositivoIp", "transaccionPasarelaCodigoAutorizacion", 
                            "transaccionPasarelaCodigoReferencia", "transaccionPasarelaCodigoRespuesta", "transaccionPasarelaComision", 
                            "transaccionPasarelaIgv", "transaccionPasarelaMontoDepositar", "transaccionEmpresaId", "transaccionLocalId", "transaccionOrdenId"];
    
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo("App\Estado", "transaccionEstadoId");
        //return $this->belongsTo("App\Unidad_medida");
    }

    public function orden(){
    	return $this->belongsTo('App\Orden' , 'transaccionOrdenId', 'ordenId');
    }

    public function local(){
    	return $this->belongsTo('App\Local' , 'transaccionLocalId', 'localId');
    }
}
