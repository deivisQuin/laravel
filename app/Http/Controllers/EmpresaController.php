<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Empresa;
use App\Transaccion;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usersRolId = Auth::user()->usersRolId;
        //Se consulta si el usuario es empresa o no
        if($usersRolId == 1){
            //Se obtiene los datos de las empresas
            $aEmpresa = Empresa::paginate(10);
            if($request->ajax()){
                return response()->json(view("empresa.listarEmpresaPartial", compact("aEmpresa"))->render());
            }
            return view("empresa.listarEmpresa", compact("aEmpresa"));
        } else {
            return view('home');         
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function crear()
    {
        return view('empresa.crearEmpresa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            "empresaRuc" => "required|numeric",
            "empresaRazonSocial" => "required|between:5,50",
            "empresaNombreComecial" => "required|between:1,50",
            "empresaNumeroCuenta" => "required|between:10,50",
            "empresaRepresentante" => "required|between:1,50",
            "empresaEmail" => "required|between:1,50|email",
            "empresaUsersId" => "required|numeric|between:1,10"
        ]);

        $aEmpresa = $request->except("_token");

        $aEmpresa["empresaNombre"] = $request->input("empresaNombreComecial");
        $aEmpresa["empresaUsuarioCrea"] = 1;
        $aEmpresa["empresaFechaCrea"] = date("Y-m-d H:m:s");

        Empresa::insert($aEmpresa);

        return redirect()->back()->with("success", "La Empresa " . $aEmpresa['empresaRazonSocial']. " ha sido registrada");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aEmpresa = Empresa::where("empresaId", "=", $id)->first();
        return view('empresa.crearEmpresa', compact("aEmpresa"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEmpresa)
    {
        $aEmpresa = $request->except(["_token", "_method"]);
        Empresa::where("empresaId", "=", $idEmpresa)->update($aEmpresa);

        $success = "Se actualizó la empresa";
        $aEmpresa = Empresa::where("empresaId", "=", $idEmpresa)->first();
        //return view('empresa.crearEmpresa', compact(["aEmpresa", "success"]));
        return redirect()->back()->with("success", "Se modificó los datos de la empresa: " . $aEmpresa['empresaRazonSocial']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function obtenerRuc($empresaRuc){
        $aEmpresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        if ( isset($aEmpresa->empresaId) ) {   
            return view("inicio", compact("aEmpresa"));
        } else {
            return view("empresaNoRegistrada", compact("aEmpresa"));
        }

    }

    public function validarFormulario(Request $request){
        $aEmpresa = Empresa::where([["empresaRuc", "=", $request->input("empresaRuc")]])->first();

        if(!$aEmpresa){
            return response()->json(["success" => false, "mensajeError"=>"Comercio no registrado en el Sistema"]);
        }

        if($request->input("empresaEmail") != $aEmpresa->empresaEmail) {
            return response()->json(["success" => false, "mensajeError"=>"El correo de la empresa no pertence al RUC registrado"]);
        }

        $validaciones = $request->validate([
            'monto' => 'required|numeric|min:5|max:5000',
            'producto' => 'required|between:5,250',
        ]);

        return response()->json(["success" => false, "mensajeError"=>false]);
    }
}
