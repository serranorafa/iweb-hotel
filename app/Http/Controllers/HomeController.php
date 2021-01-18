<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the contact page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Show the Who Are We page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function whoarewe()
    {
        return view('whoarewe');
    }

    /**
     * Show the Gallery page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gallery()
    {
        $roomPhotos = \File::allFiles(public_path('/img/room'));
        $restaurantPhotos = \File::allFiles(public_path('/img/restaurant'));
        $salaPhotos = \File::allFiles(public_path('/img/sala'));
        return view('gallery')
                    ->with(array('roomPhotos'=>$roomPhotos))
                    ->with(array('restaurantPhotos'=>$restaurantPhotos))
                    ->with(array('salaPhotos'=>$salaPhotos));
    }
}
