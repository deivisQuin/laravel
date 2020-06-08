<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estado";
    protected $primaryKey = "estadoId";
	protected $fillable = ["estadoNombreCorto", "estadoNombre", "estadoObservacion"];
    public $timestamps = false;

    public function empresas(){
    	//return $this->belongsTo("App\Unidad_medida");
    	return $this->hasMany('App\Empresa' , 'empresaEstadoId');
    }

    public function transacciones(){
    	return $this->hasMany('App\Transaccion' , 'transaccionEstadoId');
    }
}
