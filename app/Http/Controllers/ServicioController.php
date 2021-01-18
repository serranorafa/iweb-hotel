<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Estancia;
use Illuminate\Support\Facades\DB;
class ServicioController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('servicios.list', ['servicios' => Servicio::whereNotNull('id')->paginate(5)]);
    }
    public function details($id)
    {
        $servicio = Servicio::find($id);
        return view('servicios.details', ['servicio' => $servicio]);
    }
    public function createForm()
    {
        return view('servicios.create');
    }
    public function edit($id)
    {
        $servicio = Servicio::find($id);
        return view('servicios.edit', ['servicio' => $servicio]);
    }
}
