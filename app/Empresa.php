<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = "empresa";
    protected $primaryKey = "empresaId";
	protected $fillable = ["empresaNombre", "empresaRuc", "empresaRazonSocial", "empresaNombreComecial", "empresaNumeroCuenta", "empresaTelefono", "empresaDireccion", "empresaRepresentante", "empresaEstadoId", "empresaUsuarioCrea", "empresaFechaCrea", "empresaUsuarioModifica", "empresaFechaModifica"];
    public $timestamps = false;

    public function estado(){
        return $this->belongsTo("App\Estado", "empresaEstadoId");
    }

    public function lineas(){
    	return $this->belongsToMany(Linea::class);
    }

    public function productos(){
    	return $this->belongsToMany(Producto::class);
    }
}
