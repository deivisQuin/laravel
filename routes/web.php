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

Auth::routes(["reset" => false, "register" => false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

//Pago libre:
//Otro inicio con el RUC
Route::get("empresa/{empresaRuc}", "EmpresaController@obtenerRuc");
Route::post("empresa/transaccion", "CorreoController@sendMail");

//Al concluir la transaccion el sistema le muestra la respuesta de agradecimiento
Route::get("gracias/graciasCambioEstado/{transaccionId}/{transaccionTipo}", "TransaccionController@graciasCambioEstado");

//Cambiar estado de los pedidos cliente a Recepcionado y Comercio a Entregado
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");

//Problemas con la tarjeta (Si la tarjeta no es aceptada por la pasarella)
Route::get("tarjetaNoProcede/{mensajeUsuario}", "TransaccionController@tarjetaNoProcede");

//Se valida datos del formulario
Route::post("empresa/validarFormulario", "EmpresaController@validarFormulario");

//Se concluye transacción
Route::get("gracias", "TransaccionController@gracias");

//Paginas de errores (Se redireccionan)
Route::any('{catchall}', function() {
    return Response::view('error.error404', [], 404);
 })->where('catchall', '.*');

 Route::any('{catchall}', function() {
    return Response::view('error.error403', [], 403);
 })->where('catchall', '.*');