<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = "local";
    protected $primaryKey = "localId";
            
    protected $fillable = ["localEmpresaId", "localNombre", "localEmail", "localHoraApertura", "localHoraCierre", "localEstadoId", 
                            "localTelefono", "localDireccion", "localRepresentante", "localUbigeoId", "localDeliveryHabilitado", 
                            "localUsuarioCrea", "localFechaCrea", "localUsuarioModifica", "localFechaModifica"];
    
    public function estado(){
        return $this->hasOne(Estado::class, "estadoId", "localEstadoId");
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, "localEmpresaId", "empresaId");
    }

    public function ubigeo(){
        return $this->hasOne(Ubigeo::class, "ubigeoId", "localUbigeoId");
    }
}
