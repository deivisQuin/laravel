<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = "empresa";
    protected $primaryKey = "empresaId";
    protected $fillable = ["empresaNombre", "empresaRuc", "empresaRazonSocial", "empresaNombreComecial", "empresaNumeroCuenta", 
                            "empresaTelefono", "empresaDireccion", "empresaRepresentante", "empresaEstadoId", "empresaUsuarioCrea", 
                            "empresaFechaCrea", "empresaUsuarioModifica", "empresaFechaModifica"];
    
    public function estado(){
        return $this->hasOne(Estado::class, "estadoId", "empresaEstadoId");
    }

/*
    public function estado(){
        return $this->belongsTo("App\Estado", "empresaEstadoId");
    }*/
/*
    public function lineas(){
    	return $this->belongsToMany(Linea::class);
    }

    public function productos(){
    	return $this->belongsToMany(Producto::class);
    }

    public function empresa_ubigeos(){
        return $this->hasMany(EmpresaUbigeo::class, "empresaId", "EUEmpresaId");
    }*/
}
