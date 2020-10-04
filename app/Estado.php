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
    	return $this->hasMany('App\Empresa' , 'empresaEstadoId');
    }

    public function transacciones(){
    	return $this->hasMany('App\Transaccion' , 'transaccionEstadoId');
    }

    public function lineas(){
    	return $this->hasMany('App\Linea' , 'lineaEstadoId');
    }

    public function sublineas(){
    	return $this->hasMany('App\Sublinea' , 'sublineaEstadoId');
    }

    public function ordens(){
    	return $this->hasMany('App\Orden' , 'ordenEstadoId');
    }
}
