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

    public function index(){
        $aUser = User::paginate(10);
        return view("user.listarUser", compact("aUser"));
    }
}
