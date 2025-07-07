<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi_SPP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data = Transaksi_SPP::
            // join("spp_siswa", "spp_siswa.id_spp_siswa", "=", "transaksi_spp.id_spp")
            // ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
            // orderBy("database_biodata_siswa.nama_lengkap", "asc")
            orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->groupBy("tahun_ajaran","semester", "bulan")
            ->select(
                "transaksi_spp.tahun_ajaran",
                "transaksi_spp.semester",
                "transaksi_spp.bulan",
                DB::raw('count(*) as jumlah')
                )
            ->paginate(10);
        $tahun_ajaran = DB::table("transaksi_spp")->select("tahun_ajaran")->distinct()->get();
        return view('SPP.home')->with(["data" => $data, "tahun_ajaran" => $tahun_ajaran]);
    }
}
