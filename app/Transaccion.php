<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
	protected $table = "transaccion";
    protected $primaryKey = "transaccionId";
    protected $fillable = ["transaccionComercioCorreo", "transaccionComercioPassword", "transaccionComercioPasswordLink", "transaccionClienteCorreo", "transaccionClientePassword", "transaccionClientePasswordLink", "transaccionMonto", "transaccionDescripcion", "transaccionEstado", "transaccionUsuarioCrea", "transaccionFechaCrea", "transaccionComercioEstado", "transaccionComercioFechaModifica", "transaccionClienteEstado", "transaccionClienteFechaModifica"];
    
    public $timestamps = false;
}
