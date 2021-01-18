<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bloqueo;
use Illuminate\Support\Facades\DB;
class BloqueoController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('bloqueos.list', ['bloqueos' => Bloqueo::whereNotNull('id')->paginate(5)]);
    }
    public function details($id)
    {
        $bloqueo = Bloqueo::find($id);
        return view('bloqueos.details', ['bloqueo' => $bloqueo]);
    }
    public function createForm()
    {
        return view('bloqueos.create');
    }
    public function edit($id)
    {
        $bloqueo = Bloqueo::find($id);
        return view('bloqueos.edit', ['bloqueo' => $bloqueo]);
    }
}
