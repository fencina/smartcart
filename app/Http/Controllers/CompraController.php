<?php

namespace App\Http\Controllers;

class CompraController extends Controller
{
    public function index(){
        return view('compras.index');
    }
}