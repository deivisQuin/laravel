<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Transaccion;

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

    //visualizar las ventas de la empresa
    /*public function visualizarVentas($empresaRuc){
        $empresa = Empresa::where([["empresaRuc", "=", $empresaRuc],["empresaEstadoId", "=", "1"]])->first();

        if (!$empresa) {
            return "La empresa no está habilitado.";
        }

        $aEmpresa["empresaId"] = $empresa->empresaId;
        $aEmpresa["empresaNombre"] = $empresa->empresaNombre;
        $aEmpresa["empresaEmail"] = $empresa->empresaEmail;
        $aEmpresa["empresaRuc"] = $empresa->empresaRuc;
        $aEmpresa["empresaRazonSocial"] = $empresa->empresaRazonSocial;
        
        //Se obtiene las ventas de la empresa
        $transaccion = Transaccion::where('transaccionComercioCorreo', "=", "juangalarza1234@gmail.com")->get();

        if (!$transaccion) {
            return "La empresa no tiene transacciones realizadas";
        }
        
        $i = 0;
        foreach ($transaccion as $a_transaccion) {    
            $aTransaccion[$i]["transaccionComercioEstado"] = $a_transaccion->transaccionComercioEstado;
            $aTransaccion[$i]["transaccionClienteEstado"] = $a_transaccion->transaccionClienteEstado;
            $aTransaccion[$i]["transaccionMonto"] = $a_transaccion->transaccionMonto;
            $aTransaccion[$i]["transaccionDescripcion"] = $a_transaccion->transaccionDescripcion;
            $aTransaccion[$i]["transaccionEstadoId"] = $a_transaccion->transaccionEstadoId;
            $aTransaccion[$i]["transaccionFechaCrea"] = $a_transaccion->transaccionFechaCrea;
            $aTransaccion[$i]["transaccionPasarelaMonedaCodigo"] = $a_transaccion->transaccionPasarelaMonedaCodigo;
            $aTransaccion[$i]["transaccionPasarelaBancoNombre"] = $a_transaccion->transaccionPasarelaBancoNombre;
            $aTransaccion[$i]["transaccionPasarelaBancoPaisNombre"] = $a_transaccion->transaccionPasarelaBancoPaisNombre;
            $aTransaccion[$i]["transaccionPasarelaTarjetaMarca"] = $a_transaccion->transaccionPasarelaTarjetaMarca;
            $aTransaccion[$i]["transaccionPasarelaTarjetaTipo"] = $a_transaccion->transaccionPasarelaTarjetaTipo;
            $aTransaccion[$i]["transaccionPasarelaTarjetaTipo"] = $a_transaccion->transaccionPasarelaTarjetaTipo;
            $i++;
        }

        $aEmpresaTransaccion = array("aEmpresa"=>$aEmpresa,"aTransaccion"=>$aTransaccion);
//dump($aEmpresaTransaccion);
//        return "entro a ver las ventas";
        return view("empresaTransaccion/empresaTransaccion", compact("aEmpresaTransaccion"));
    }*/
}
