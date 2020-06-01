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
Route::get("ajaxRequest", "AjaxController@create");

Route::post("ajaxRequest", "MessageReceivedController@sendMail");

Route::post("envioCorreoComercio", "MessageReceivedController@enviarCorreoComercio");

Route::post("envioCorreoCliente", "MessageReceivedController@enviarCorreoCliente");

Route::get("gracias", "AjaxController@index");

//cambiamos la linea

//respuesta de comercio y cliente
Route::get("nuevoEstado/{transaccionId}/{passwordLink}/{transaccionTipo}", "TransaccionController@editarEstado");
Route::post("nuevoEstado", "TransaccionController@modificarEstado");
Route::get("nuevoEstado/{transaccionId}/gracias", "TransaccionController@gracias");

//Fin a respuesta de comercio y cliente