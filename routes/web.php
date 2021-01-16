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

//Se muestra las ventas del local
Route::post("/listarTransaccion", "TransaccionController@ventasLocal")->middleware("auth");
Route::get("/listarLocal/{empresaId}", "LocalController@listar")->middleware("auth");

//Se agrega el registro de usuarios
//Route::get("/registrar", "Auth\RegisterController@registrarUsuario");

//Transaccion (Se obtienen las ventas del comercio)
//Route::post("transaccion/ventasEmpresa", "TransaccionController@ventasEmpresa"); descontinuado se usará "ventasLocal"


Route::post("transaccion/{transaccionId}/ver", "TransaccionController@obtener");

Route::get("ventaDiarioLocal", "TransaccionController@ventaDiarioLocal");

//CRUD de las empresas
Route::get("empresa/listar", "EmpresaController@index")->middleware("auth");

Route::get("empresa/crear", "EmpresaController@crear")->middleware("auth");

Route::post("empresa", "EmpresaController@store")->middleware("auth");

Route::get("empresa/{empresaId}/editar", "EmpresaController@edit")->middleware("auth");

Route::put("empresa/{empresaId}", "EmpresaController@update")->middleware("auth");


//Listado de Usuarios
Route::get("usuario/listar", "UserController@index");

//Producto
Route::get("producto/obtener/{productoId}/{localId}", "ProductoController@obtenerProducto");

Route::post("producto/validarFormularioCarrito", "ProductoController@validarFormularioCarrito");
//Route::post("producto/transaccion", "CorreoController@sendMail");
Route::post("producto/transaccion", "TransaccionController@registrar");
//Route::get("producto/correo", "CorreoController@enviarCorreo");
Route::get("producto/obtenerLocalUbigeoDelivery/{localUbigeoId}", "LocalUbigeoDeliveryController@obtenerJson");
Route::get("producto/listarLocalUbigeoDelivery/{localId}", "LocalUbigeoDeliveryController@listar");
Route::post("producto/registrarOrden", "OrdenController@crear");
Route::get("producto/listarSalsa/{localId}", "SalsaController@listarJson");
Route::get("producto/listarProductoSalsa/{productoId}/{productoCantidad}/{localId}/{numElementosEncontrados}", "ProductoController@listarProductoSalsa");

Route::get("/listarProducto", "ProductoController@listar")->middleware("auth");

Route::get("producto/listarProductoLocal/{localId}", "ProductoController@listarProductoLocal");

Route::post("modificarLocalLineaSublineaProducto", "LocalLineaSublineaProductoController@modificar");

Route::get("/listarSalsa", "SalsaController@listar")->middleware("auth");
Route::post("modificarSalsa", "SalsaController@modificar");

//Pago libre:
//Los clientes inician con el RUC del comercio (Empresa)
Route::get("empresa/{empresaRuc}", "EmpresaController@obtenerRuc")->middleware("throttle:3");//throttle:3 max número de intentos

//LOs clientes inician escogiendo los productos de la empresa
//Route::get("producto/{empresaRuc}", "ProductoController@obtenerRuc")->middleware("throttle:3");
Route::get("producto/{empresaRuc}", "ProductoController@obtenerRuc");

//Se valida datos del formulario
Route::post("empresa/validarFormulario", "EmpresaController@validarFormulario");

//Problemas con la tarjeta (Si la tarjeta no es aceptada por la pasarella)
Route::get("tarjetaNoProcede/{mensajeUsuario}", "TransaccionController@tarjetaNoProcede");

//Registra la transacción y envía los correos
Route::post("empresa/transaccion", "CorreoController@sendMail");

//Se concluye la transacción
Route::get("gracias/{localId}", "TransaccionController@gracias");


//Cambiar estado de los pedidos cliente a Recepcionado y Comercio a Entregado
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");

//Al concluir la transaccion el sistema le muestra la respuesta de agradecimiento
Route::get("gracias/graciasCambioEstado/{transaccionId}/{transaccionTipo}", "TransaccionController@graciasCambioEstado");


//PRUEBA QR ELIMINAR
Route::get("gracias/graciasQR", "TransaccionController@graciasQR");
// https://github.com/SimpleSoftwareIO/simple-qrcode/issues/21  revisar la siguiente página.

Route::get('qrcode', function () {
    return QrCode::size(250)
        ->backgroundColor(255, 255, 204)
        ->format('png')
        ->generate('MyNotePaper');
    //return view("emails.mensajeConfirmacionQR");
});

//Paginas de errores (Se redireccionan)
Route::any('{catchall}', function() {
    return Response::view('error.error404', [], 404);
 })->where('catchall', '.*');

 Route::any('{catchall}', function() {
    return Response::view('error.error403', [], 403);
 })->where('catchall', '.*');
