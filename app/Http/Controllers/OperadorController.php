<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Operator;

class OperadorController extends Controller {
    public function index(){
        $operadores = \App\Operator::all();
        return view('operador.index',["operadores"=>$operadores]);
    }
    public function create(){
        echo 'create';
    }
    public function store(Request $request){
        echo 'store';
    }
    public function show($id){
        $operador = \App\Operator::find($id);
        return view('operador.show', ["operador" => $operador]);
    }
    public function edit($id){
        echo 'edit';
    }
    public function update(Request $request, $id){
        echo 'update';
    }
    public function destroy($id){
        echo 'destroy';
    }
}