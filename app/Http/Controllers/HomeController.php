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
    public function roomGallery()
    {
        $photos = \File::allFiles(public_path('/img/room'));
        $dir = '/img/room/';
        return view('gallery', ['dir' => $dir])->with(array('photos'=>$photos));
    }

    public function hallGallery()
    {
        $photos = \File::allFiles(public_path('/img/sala'));
        $dir = '/img/sala/';
        return view('gallery', ['dir' => $dir])->with(array('photos'=>$photos));
    }

    public function restaurantGallery()
    {
        $photos = \File::allFiles(public_path('/img/restaurant'));
        $dir = '/img/restaurant/';
        return view('gallery', ['dir' => $dir])->with(array('photos'=>$photos));
    }
}
