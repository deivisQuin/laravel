<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sublinea extends Model
{
    protected $table = "sublinea";
    protected $primaryKey = "sublineaId";
	protected $fillable = ["sublineaNombre", "sublineaNombreCorto", "sublineaLineaId", "sublineaEstadoId"];
    public $timestamps = false;

    public function linea(){
    	return $this->belongsTo("App\Linea", "sublineaLineaId");
    }

    public function estado(){
    	return $this->belongsTo("App\Estado", "sublineaEstadoId");
    }
}
