<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EmpresaUbigeo;

class EmpresaUbigeoController extends Controller
{
    public function obtenerJson($empresaUbigeoId){
        $aEmpresaUbigeoId = EmpresaUbigeo::findOrFail($empresaUbigeoId);
        return response()->json(["success" => true, "aEmpresaUbigeoId"=>$aEmpresaUbigeoId]);
    }
}
