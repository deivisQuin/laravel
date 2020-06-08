<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaccion;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    public function tarjetaNoProcede(){
        return view("tarjetaNoProcede");   
    }

    public function gracias(){
        return view("gracias");
    }
}
