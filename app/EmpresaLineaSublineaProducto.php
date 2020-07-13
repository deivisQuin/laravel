<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaLineaSublineaProducto extends Model
{
    protected $table = "empresa_linea_sublinea_producto";
    protected $primaryKey = "ELSPId";
	protected $fillable = ["ELSPEmpresaId", "ELSPLineaId", "ELSPSublineaId", "ELSPProductoId"];
    public $timestamps = false;

    public function empresa(){
    	return $this->belongsTo(Empresa::class);
    }

    public function linea(){
    	return $this->belongsTo(Linea::class);
    }

    public function sublinea(){
    	return $this->belongsTo(Sublinea::class);
    }

    public function producto(){
    	return $this->belongsTo(Producto::class, "ELSPProductoId");
    }
}
