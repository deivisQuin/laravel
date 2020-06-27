<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('auth.login');
});

//Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(["reset" => false, "register" => false]);//register=>true si desea registrar usuario;false si no desea registrar usuario

Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

//Transaccion
Route::post("transaccion/ventasEmpresa", "TransaccionController@ventasEmpresa");




//Pago libre:
//Se inicia con el RUC
Route::get("empresa/{empresaRuc}", "EmpresaController@obtenerRuc")->middleware("throttle:3");//throttle:3 max número de intentos

//Se valida datos del formulario
Route::post("empresa/validarFormulario", "EmpresaController@validarFormulario");

//Problemas con la tarjeta (Si la tarjeta no es aceptada por la pasarella)
Route::get("tarjetaNoProcede/{mensajeUsuario}", "TransaccionController@tarjetaNoProcede");

//Registra la transacción y envía los correos
Route::post("empresa/transaccion", "CorreoController@sendMail");

//Se concluye transacción
Route::get("gracias", "TransaccionController@gracias");


//Cambiar estado de los pedidos cliente a Recepcionado y Comercio a Entregado
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");

//Al concluir la transaccion el sistema le muestra la respuesta de agradecimiento
Route::get("gracias/graciasCambioEstado/{transaccionId}/{transaccionTipo}", "TransaccionController@graciasCambioEstado");


 //Usuarios pueden entrar a visualizar sus ventas
 //Route::get("comercio/{empresaRuc}","EmpresaController@visualizarVentas")->middleware("auth");




//Paginas de errores (Se redireccionan)
Route::any('{catchall}', function() {
    return Response::view('error.error404', [], 404);
 })->where('catchall', '.*');

 Route::any('{catchall}', function() {
    return Response::view('error.error403', [], 403);
 })->where('catchall', '.*');
