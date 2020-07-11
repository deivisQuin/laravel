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

Auth::routes(["reset" => true, "register" => true]);//register=>true si desea registrar usuario;false si no desea registrar usuario

Route::get('/home', 'HomeController@index')->name('home')->middleware("auth");

//Se agrega el registro de usuarios
//Route::get("/registrar", "Auth\RegisterController@registrarUsuario");

//Transaccion (Se obtienen las ventas del comercio)
Route::post("transaccion/ventasEmpresa", "TransaccionController@ventasEmpresa");

Route::post("transaccion/{transaccionId}/ver", "TransaccionController@obtener");


//CRUD de las empresas
Route::get("empresa/listar", "EmpresaController@index")->middleware("auth");

Route::get("empresa/crear", "EmpresaController@crear")->middleware("auth");

Route::post("empresa", "EmpresaController@store")->middleware("auth");

Route::get("empresa/{empresaId}/editar", "EmpresaController@edit")->middleware("auth");

Route::put("empresa/{empresaId}", "EmpresaController@update")->middleware("auth");


//Listado de Usuarios
Route::get("usuario/listar", "UserController@index");


//Pago libre:
//Los clientes inician con el RUC del comercio (Empresa)
Route::get("empresa/{empresaRuc}", "EmpresaController@obtenerRuc")->middleware("throttle:3");//throttle:3 max número de intentos

//Se valida datos del formulario
Route::post("empresa/validarFormulario", "EmpresaController@validarFormulario");

//Problemas con la tarjeta (Si la tarjeta no es aceptada por la pasarella)
Route::get("tarjetaNoProcede/{mensajeUsuario}", "TransaccionController@tarjetaNoProcede");

//Registra la transacción y envía los correos
Route::post("empresa/transaccion", "CorreoController@sendMail");

//Se concluye la transacción
Route::get("gracias", "TransaccionController@gracias");


//Cambiar estado de los pedidos cliente a Recepcionado y Comercio a Entregado
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");

//Al concluir la transaccion el sistema le muestra la respuesta de agradecimiento
Route::get("gracias/graciasCambioEstado/{transaccionId}/{transaccionTipo}", "TransaccionController@graciasCambioEstado");


//Paginas de errores (Se redireccionan)
Route::any('{catchall}', function() {
    return Response::view('error.error404', [], 404);
 })->where('catchall', '.*');

 Route::any('{catchall}', function() {
    return Response::view('error.error403', [], 403);
 })->where('catchall', '.*');
