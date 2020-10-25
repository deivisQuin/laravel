<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salsa extends Model
{
    protected $table = "salsa";
    protected $primaryKey = "salsaId";
            
    protected $fillable = ["salsaLocalId", "salsaNombre", "salsaEstadoId", "salsaUsuarioCrea", 
                            "salsaFechaCrea", "salsaUsuarioModifica", "salsaFechaModifica"];
    
    public function estado(){
        return $this->hasOne(Estado::class, "estadoId", "salsaEstadoId");
    }

    public function local(){
        return $this->hasOne(Local::class, "localId", "salsaLocalId");
    }
}
