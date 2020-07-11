<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(Request $request){
        $aUser = User::paginate(10);
        if ($request->ajax()) {
            return response()->json(view("user.listarUserPartial", compact("aUser"))->render());
        }
        return view("user.listarUser", compact("aUser"));
    }
}
