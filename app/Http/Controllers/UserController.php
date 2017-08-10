<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

    public function index(){
        $users = User::all();
        return view('users.index',["users"=>$users]);
    }

    public function create(){
        echo 'create';
    }

    public function store(Request $request){
        echo 'store';
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show', ["user" => $user]);
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