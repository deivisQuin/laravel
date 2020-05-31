<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
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
        $aTransaccion = Transaccion::findOrFail($id);
        //dd($aTransaccion);
        //Transaccion::where([["transaccionId", "=", $id],["", "=", $passwordLink]])
        return view("cambiarEstado", compact("aTransaccion"));
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
        //retirar campos del framework
        $contrasena = $request->input("contrasena");
        $nuevoEstado = $request->input("nuevoEstado");

        //Seleccionas la transaccion
        $aTransaccion = Transaccion::where([["transaccionId", "=", $id],["transaccionPasswordComercio", "=", $contrasena]])->get();
        //$aTransaccion = Transaccion::where("transaccionId", "=", $id)->get();

        if (count($aTransaccion) > 0) {
            //actualiza
            $update = DB::update("update transaccion set transaccionComercioEstado = 2 where transaccionId  = ?", [$id]);

            return redirect("nuevoEstado/$id/gracias");
        }
        
        return redirect("cambiarEstado/$id/edit");
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

    public function editarEstado($id, $passwordLink, $tipoTransaccion){
        if ($tipoTransaccion == 1) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $id],["transaccionComercioPasswordLink", "=", $passwordLink]])->first();
        } elseif ($tipoTransaccion == 2) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $id],["transaccionClientePasswordLink", "=", $passwordLink]])->first();
        } else {
            return "El tipo de Transacción es Incorrecto";
        }
        
        if ( isset($aTransaccion->transaccionId) ) {
            $aTransaccion->tipoTransaccion = $tipoTransaccion;
        
            return view("modificarEstado", compact("aTransaccion"));
        }

        return "usted no tiene acceso a la página";
    }

    public function modificarEstado(Request $request, $id){

        $password = $request->input("contrasena");
        $tipoTransaccion = $request->input("tipoTransaccion");
        $transaccionCienteComercioPasswordLink = $request->input("transaccionCienteComercioPasswordLink");

        //Se obtiene los datos de la transaccion
        if ($tipoTransaccion == 1) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $id],["transaccionComercioPasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionComercioPassword", "=", $password]])->first();
        } elseif ($tipoTransaccion == 2) {
            $aTransaccion = Transaccion::where([["transaccionId", "=", $id],["transaccionClientePasswordLink", "=", $transaccionCienteComercioPasswordLink], ["transaccionClientePassword", "=", $password]])->first();
        } else {
            return "La transacción no existe";
        }

        if (isset($aTransaccion->transaccionId)) {
            // Se modifica el estado 
            if ($tipoTransaccion == 1) {
                $update = DB::update("update transaccion set transaccionComercioEstado = 2 where transaccionId  = ?", [$id]);
            } else {
                $update = DB::update("update transaccion set transaccionClienteEstado = 2 where transaccionId  = ?", [$id]);
            }
    
            return redirect("nuevoEstado/$id/gracias");

        } else {
            return "Los datos ingresados no son los correctos";
        }

        
    }

    public function gracias($id){

        //Obtenemos los estados del pedido
        $aTransaccion = Transaccion::findOrFail($id);
        return view("nuevoEstadoGracias", compact("aTransaccion"));
        
    }
}
