<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Empresa;
use App\UserLocal;
use App\Transaccion;

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

        if (count($oUserLocal) < 1) {
            //$aEmpresa = Empresa::all();
            $aEmpresa = Empresa::where("empresaEstadoId", "=", 1)->get();

            return view('empresa.homeEmpresa', compact("aEmpresa"));
        }

        if ($usersRolId == 3) {$fechaHoy = date("Y-m-d");
            $fechaHoy = "2020-10-19";
            //Se obtiene las ventas de la empresa
            $aTransaccion = Transaccion::where("transaccionLocalId", "=", 1)
                ->where("transaccionFechaCrea", "like", "$fechaHoy%")
                ->orderBy("transaccionId", "desc")
                ->paginate(10);
            return view('empresa.listarTransaccion', compact("aTransaccion"));
            //return response()->json(view("empresa.listarTransaccion", compact("aTransaccion"))->render());
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

        //return view('empresa.homeEmpresa', compact("aEmpresa", "usersRolId"));

        /*
        //Si el usuario no tiene rol asignado
        if(!$usersRolId){
            return view('home');
        }

        if($usersRolId == 2){
            //Se obtiene los datos de la empresa
            $aEmpresa = Empresa::where("empresaUsersId", "=", $usersId)->get();
        }

        if($usersRolId == 1){
            //Se obtiene los datos de todas las empresa
            $aEmpresa = Empresa::all();
        }

        return view('empresa.homeEmpresa', compact("aEmpresa", "usersRolId"));*/
    }
}
