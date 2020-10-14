<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    protected $table = "ubigeo";
    protected $primaryKey = "ubigeoId";
    protected $fillable = ["ubigeoCodigo", "ubigeoNombre", "ubigeoTipo"];

    public $timestamps = false;

    public function empresa_ubigeos(){
    	return $this->hasMany('App\EmpresaUbigeo' , 'ubigeoId', 'EUUbigeoId');
    }
}
