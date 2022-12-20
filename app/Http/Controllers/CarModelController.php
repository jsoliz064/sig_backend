<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index(){
        return view('modelos.index');
    }
}
