<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){
        return view("gracias");
    }

    public function create(){
    	return view("message");
    }

    public function store(Request $request){
    	return response()->json();
    }
}
