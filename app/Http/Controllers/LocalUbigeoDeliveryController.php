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

    public function listar($localId) {
        $oLocalUbigeoDelivery = LocalUbigeoDelivery::where("LULocalId", "=", $localId)->get();

        $i = 0;
        foreach ($oLocalUbigeoDelivery as $localUbigeoDelivery) {
            $aLocalUbigeoDelivery[$i]["LUId"] = $localUbigeoDelivery->LUId;
            $aLocalUbigeoDelivery[$i]["LULocalId"] = $localUbigeoDelivery->LULocalId;
            $aLocalUbigeoDelivery[$i]["LUUbigeoId"] = $localUbigeoDelivery->LUUbigeoId;
            $aLocalUbigeoDelivery[$i]["ubigeoNombre"] = $localUbigeoDelivery->ubigeo->ubigeoNombre;
            $aLocalUbigeoDelivery[$i]["LUPrecioDelivery"] = $localUbigeoDelivery->LUPrecioDelivery;
            $i++;
        }

        return response()->json($aLocalUbigeoDelivery);
    }
}
