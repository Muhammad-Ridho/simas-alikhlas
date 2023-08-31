<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;

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
        $department = Department::all();
        $asset = Asset::all();
        return view('pimpinan.index', compact('department','asset'));
    }

    public function adminHome()
    {
        $department = Department::all();
        $asset = Asset::all();
        return view('admin.index',compact('department','asset'));
    }

    public function kabagSarprasHome()
    {
        return view('kabag_sarpras.index');
    }


    public function pengelolaCabangHome()
    {
        return view('pengelola_cabang.index');
    }
}
