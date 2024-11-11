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
        // to do: buat side bar dan nav baru buat masing masing role
        $role =Auth()->user()->role;
        if($role=="Admin"){
            return view(view: 'dashboard_admin');
        }
        if($role=="Tata_Usaha"){
            return view('dashboard_tata_usaha');
        }
        if($role=="Guru"){
            return view('dashboard_guru');
        }
        if($role=="Calon_Siswa"){
            return view('dashboard_calon_siswa');
        }
    }
}
