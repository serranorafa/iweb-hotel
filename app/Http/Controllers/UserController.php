<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\CustomValidationServiceProvider;

class UserController extends Controller
{ 
    /**
     * Mensajes de error
     */
    public $customMessages = [
        'confirmed' => 'Las contraseñas no coinciden.',
        'numeric' => 'Este campo debe contener números.',
        'digits' => 'El teléfono debe contener 9 números.',
        'required' => 'Campo obligatorio.',
        'max' => 'Ha sobrepasado el número máximo de caracteres.',
        'email' => 'Introduzca una dirección de correo válida',
        'unique' => 'Ya existe un usuario con este correo electrónico.'
    ];

    /**
     * Show the user list filtered
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaResultado = User::whereNotNull('id')
                            ->when(request()->input('nombre'), function($query) {
                                $query->where('nombre', 'LIKE', '%'.request()->input('nombre').'%');
                            })
                            ->when(request()->input('apellidos'), function($query) {
                                $query->where('apellidos', 'LIKE', '%'.request()->input('apellidos').'%');
                            })
                            ->when(request()->input('email'), function($query) {
                                $query->where('email', 'LIKE', '%'.request()->input('email').'%');
                            })
                            ->when(request()->input('telefono'), function($query) {
                                $query->where('telefono', 'LIKE', '%'.request()->input('telefono').'%');
                            })
                            ->when(request()->input('telefono'), function($query) {
                                $query->where('telefono', 'LIKE', '%'.request()->input('telefono').'%');
                            })
                            ->when(request()->input('rol'), function($query) {
                                $query->where('rol', request()->input('rol'));
                            });

        return view('users.list', ['users' =>  $listaResultado->paginate(5)]);
    }

    public function createForm()
    {
        return view('users.create');
    }

    public function created(Request $request) 
    { 
        $rules = [
            'password' => ['required', 'confirmed'],
            'telefono' => ['required', 'string', 'max:30'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ];

        $this->validate($request, $rules, $this->customMessages);

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

    public function details($id)
    {
        $user = User::find($id);
        return view('users.details', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    public function edited(Request $request) 
    {
        $rules = [
            'telefono' => ['required', 'string', 'max:30'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ];

        $this->validate($request, $rules, $this->customMessages);
        
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

    public function delete($id) 
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->action('UserController@index', ['users' => User::whereNotNull('id')->paginate(5)]);
    }

}
