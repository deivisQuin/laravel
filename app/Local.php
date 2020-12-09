<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = "local";
    protected $primaryKey = "localId";
            
    protected $fillable = ["localEmpresaId", "localNombre", "localEmail", "localHoraApertura", "localHoraCierre", "localEstadoId", 
                            "localTelefono", "localDireccion", "localRepresentante", "localUbigeoId", "localUsuarioCrea", 
                            "localFechaCrea", "localUsuarioModifica", "localFechaModifica"];
    
    public function estado(){
        return $this->hasOne(Estado::class, "estadoId", "localEstadoId");
    }

    public function empresa(){
        //return $this->hasOne(Empresa::class, "empresaId", "localEmpresaId");
        return $this->belongsTo(Empresa::class, "localEmpresaId");

    }

    public function ubigeo(){
        return $this->hasOne(Ubigeo::class, "ubigeoId", "localUbigeoId");
    }
}