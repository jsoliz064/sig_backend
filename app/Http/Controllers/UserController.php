<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function index(){
        return view('users.index');
    }

    //TODO: DANIEL Nose donde hiciste el crud del usuario pero ahora necesitara la llave del bus en caso sea ADMINISTRADOR de todos modos la llave esta nullable asi que si se decide crear un MICRERO dicha llave puede estar null
}
