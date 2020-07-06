<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Empresa;

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

        return view('empresa.homeEmpresa', compact("aEmpresa", "usersRolId"));

    }
}
