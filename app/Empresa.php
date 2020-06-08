<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = "empresa";
    protected $primaryKey = "empresaId";
	protected $fillable = ["empresaNombre", "empresaRuc", "empresaRazonSocial", "empresaNombreComecial", "empresaNumeroCuenta", "empresaTelefono", "empresaDireccion", "empresaRepresentante", "empresaEstadoId", "empresaUsuarioCrea", "empresaFechaCrea", "empresaUsuarioModifica", "empresaFechaModifica"];
    public $timestamps = false;
}