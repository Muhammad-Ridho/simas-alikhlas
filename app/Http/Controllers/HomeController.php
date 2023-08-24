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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pimpinan.index');
    }

    public function adminHome()
    {
        return view('admin.index');
    }

    public function kabagSarpras()
    {
        return view('kabag_sarpras.index');
    }


    public function pengelolaCabang()
    {
        return view('pengelola_cabang.index');
    }
}
