<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $role =Auth::user()->role;
        if($role==="Admin"){
            return view(view: 'dashboard_admin');
        }
        if($role==="Tata_Usaha"){
            return view('dashboard_tata_usaha');
        }
        if($role==="Guru"){
            return view('dashboard_guru');
        }
        if($role==="Siswa"){
            return view('dashboard_siswa');
        }
        return response()->json(['error' => 'Unauthorized action.'], 403);
    }

    public function indexAbsensi()
    {
        return view('absensi.home');
    }
    public function indexPelanggaran()
    {
        return view('pelanggaran.home');
    }
    public function indexPendaftaran()
    {
        return view('pendaftaran.home');
    }
    public function indexSPP()
    {
        return view('SPP.home');
    }
}
