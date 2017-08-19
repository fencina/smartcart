<?php
namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller {

    public function index(){

        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::pluck('name', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(UserFormRequest $request){
        $user = User::create($request->all());
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect('users')->withSuccess('Operador creado exitosamente');
    }

    public function edit(User $user){
        $roles = Role::pluck('name', 'id');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserFormRequest $request, User $user){

        $user->update($request->all());

        return redirect('users')->withSuccess('Operador modificado exitosamente');
    }

    public function delete(User $user)
    {
        return view('users.delete', compact('user'));
    }

    public function destroy(User $user){
        $user->delete();

        return redirect('users')->withSuccess('Operador dado de baja exitosamente');
    }
}