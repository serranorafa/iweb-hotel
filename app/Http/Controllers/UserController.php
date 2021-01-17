<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
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
    public function details($id){
        $user = User::find($id);
        return view('users.details', ['user' => $user]);
    }
    public function edit($id){
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }
}
