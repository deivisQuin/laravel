<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "producto";
    protected $primaryKey = "productoId";
    protected $fillable = ["productoNombre", "productoNombreCorto", "productoObservacion", "productoUnidadMedidaId", "productoSublineaId", 
                            "productoPrecio", "productoEstadoId", "productoUsuarioCrea", "productoFechaCrea", "productoUsuarioModifica", "productoFechaModifica"];
    public $timestamps = false;

    public function sublinea() {
    	return $this->belongsTo("App\Sublinea", "productoSublineaId");
    }

    public function estado() {
    	return $this->belongsTo("App\Estado", "productoEstadoId");
    }

    public function local_linea_sublinea_productos() {
        return $this->hasToMany(LocalLineaSublineaProducto::class);
    }

    public function empresas() {
        return $this->belongsToMany(Empresa::class);
    }

}
