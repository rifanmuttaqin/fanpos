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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if($this->getUserPermission('index home'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Home');
            return view('home.index', ['active'=>'home']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Home');
        //     return view('error.unauthorized', ['active'=>'home']);
        // }
    }
}
