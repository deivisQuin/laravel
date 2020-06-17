<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
