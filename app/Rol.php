<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rol";
    protected $primaryKey = "rolId";
	protected $fillable = ["rolNombreCorto", "rolNombre", "rolObservacion", "rolEstadoId"];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo("App\Estado", "rolEstadoId");
    }

}
