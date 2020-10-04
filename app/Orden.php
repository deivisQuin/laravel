<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = "orden";
    protected $primaryKey = "ordenId";
    protected $fillable = ["ordenDelivery", "ordenTelefono", "ordenEstadoId", "ordenTransaccionId"];
    public $timestamps = false;

    public function estado() {
    	return $this->belongsTo("App\Estado", "productoEstadoId");
    }

    public function transaccion() {
    	return $this->belongsTo("App\Transaccion", "transaccionId");
    }
    
    public function orden_detalles(){
    	return $this->hasMany('App\Orden' , 'ODOrdenId');
    }
}
