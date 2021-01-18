<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.list', ['users' =>  User::whereNotNull('id')->paginate(5)]);
    }

    public function createForm()
    {
        return view('users.create');
    }

    public function created(Request $request) {
        $usuario = new User();

        $usuario->setNombre($request->input('nombre'));
        $usuario->setApellidos($request->input('apellidos'));
        $usuario->setEmail($request->input('email'));
        $usuario->setPassword(Hash::make($request->input('password')));
        $usuario->setTelefono($request->input('telefono'));
        $usuario->setRol($request->input('rol'));

        $usuario->save();

        return redirect()->action('UserController@index', ['users' => User::whereNotNull('id')->paginate(5)]);
    }

    public function details($id){
        $user = User::find($id);
        return view('users.details', ['user' => $user]);
    }

    public function edit($id){
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    public function edited(Request $request) {
        $usuario = User::find($request->input('id'));

        $usuario->setNombre($request->input('nombre'));
        $usuario->setApellidos($request->input('apellidos'));
        $usuario->setEmail($request->input('email'));
        $usuario->setPassword(Hash::make($request->input('password')));
        $usuario->setTelefono($request->input('telefono'));
        $usuario->setRol($request->input('rol'));

        $usuario->save();

        return redirect()->action('UserController@index', ['users' => User::whereNotNull('id')->paginate(5)]);
    }

    public function delete($id) {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->action('UserController@index', ['users' => User::whereNotNull('id')->paginate(5)]);
    }
}
