<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LocalUbigeoDelivery;

class LocalUbigeoDeliveryController extends Controller
{
    public function obtenerJson($localUbigeoId){
        $oLocalUbigeo = LocalUbigeoDelivery::findOrFail($localUbigeoId);
        return response()->json(["success" => true, "oLocalUbigeo"=>$oLocalUbigeo]);
    }
}
