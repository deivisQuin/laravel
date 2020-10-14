<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaUbigeo extends Model
{
    protected $table = "empresa_ubigeo";
    protected $primaryKey = "EUId";
    protected $fillable = ["EUEmpresaId", "EUUbigeoId", "EUPrecioDelivery"];

    public $timestamps = false;

    public function ubigeo(){
        return $this->belongsTo(Ubigeo::class, "EUUbigeoId", "ubigeoId");
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, "EUEmpresaId", "empresaId");
    }
}
