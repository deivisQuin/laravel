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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Pago libre:
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");

Route::get("gracias/graciasCambioEstado/{transaccionId}/{transaccionTipo}", "TransaccionController@graciasCambioEstado");

//Problemas con la terjeta
Route::get("tarjetaNoProcede", "TransaccionController@tarjetaNoProcede");

//Otro inicio con el RUC
Route::get("empresa/{empresaRuc}", "EmpresaController@obtenerRuc");
Route::post("empresa/transaccion", "CorreoController@sendMail");

//Se valida datos del formulairio
Route::post("empresa/validarFormulario", "EmpresaController@validarFormulario");

//Se concluye gtransacción
Route::get("gracias", "TransaccionController@gracias");