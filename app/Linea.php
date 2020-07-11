<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $table = "linea";
    protected $primaryKey = "lineaId";
	protected $fillable = ["lineaNombre", "lineaNombreCorto", "lineaEstadoId"];
    public $timestamps = false;

    public function empresas(){
    	return $this->belongsToMany(Empresa::class);
    }

    public function estado(){
    	return $this->belongsTo("App\Estado", "lineaEstadoId");
    }
}