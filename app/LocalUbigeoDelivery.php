<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalUbigeoDelivery extends Model
{
    protected $table = "local_ubigeo_delivery";
    protected $primaryKey = "LUId";
    protected $fillable = ["LULocalId", "LUUbigeoId", "LUPrecioDelivery"];

    public function ubigeo() {
    	return $this->belongsTo("App\Ubigeo", "LUUbigeoId");
    }

    public function local() {
        return $this->belongsTo("App\Local", "LULocalId");
    }
}
