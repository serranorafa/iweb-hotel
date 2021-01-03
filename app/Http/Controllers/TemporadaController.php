<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temporada;
use Illuminate\Support\Facades\DB;
class TemporadaController extends Controller
{
    /**
     * Show the user list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('temporadas.list', ['temporadas' => Temporada::whereNotNull('id')->paginate(5)]);
    }}
