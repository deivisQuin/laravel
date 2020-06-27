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

        //Se consulta si el usuario es empresa o no
        if($usersRolId == 2){
            //Se obtiene los datos de la empresa
            $aEmpresa = Empresa::where("empresaUsersId", "=", $usersId)->get();

            return view('empresa.homeEmpresa', compact("aEmpresa"));
        } else {
            return view('home');            
        }
        

        //return view('home');
    }
}
