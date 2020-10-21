<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalLineaSublineaProducto extends Model
{
    protected $table = "local_linea_sublinea_producto";
    protected $primaryKey = "LLSPId";
	protected $fillable = ["LLSPLocalId", "LLSPLineaId", "LLSPSublineaId", "LLSPProductoId", "LLSPPrecio", "LLSPEstadoId", "LLSPImagen"];
    
    public function producto(){
    	return $this->hasOne(Producto::class, "productoId", "LLSPProductoId");
    }
}
