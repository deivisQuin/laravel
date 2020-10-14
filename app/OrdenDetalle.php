<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $table = "orden_detalle";
    protected $primaryKey = "ODId";
    protected $fillable = ["ODOrdenId", "ODProductoId", "ODCantidad"];
    public $timestamps = false;

    public function orden() {
    	return $this->belongsTo("App\Orden", "ordenId");
    }

}
