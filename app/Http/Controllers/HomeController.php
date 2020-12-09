<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Empresa;
use App\UserLocal;
use App\Transaccion;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersRolId = Auth::user()->usersRolId;
        $usersId = Auth::id();

        if (!$usersRolId) {
            return view('home');
        }

        //Se obtiene los locales
        $oUserLocal = UserLocal::where("ULUsersId", "=", $usersId)->get();
        $localId    = $oUserLocal[0]->ULLocalId;

        if (count($oUserLocal) < 1) {
            //$aEmpresa = Empresa::all();
            $aEmpresa = Empresa::where("empresaEstadoId", "=", 1)->get();

            return view('empresa.homeEmpresa', compact("aEmpresa"));
        }

        if ($usersRolId == 3) {
            $aTransaccion = DB::table("transaccion")
                ->leftJoin("orden", "transaccion.transaccionOrdenId", "=", "orden.ordenId")
                ->leftJoin("local_ubigeo_delivery", "orden.ordenLUId", "=", "local_ubigeo_delivery.LUId")
                ->where("orden.ordenEstadoId", "=", 1) 
                ->where("transaccion.transaccionLocalId", "=", $localId)                            
                ->get();

            return view('empresa.listarTransaccion', compact("aTransaccion"));
        }

        $empresaId = 0;

        foreach ($oUserLocal as $userLocal) {
            $aLocal[] = $userLocal->local;
            
            if ($empresaId != $userLocal->local->empresa->empresaId) {
                $aEmpresa[] = $userLocal->local->empresa;
            }

            $empresaId = $userLocal->local->empresa->empresaId;   
        }

        return view('empresa.homeEmpresa', compact("aEmpresa"));

    }
}
