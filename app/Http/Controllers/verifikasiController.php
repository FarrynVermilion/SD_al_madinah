<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\verifikasi_SPP;
use Illuminate\Support\Facades\DB;

class verifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $verifikasi_spp = verifikasi_SPP::where("status_verifikasi", 0)
        ->leftJoin("transaksi_spp", "verifikasi_spp.id_verifikasi", "=", "transaksi_spp.id_transaksi")
        ->leftJoin("spp_siswa", "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
        ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->whereNotNull("NIS.id_NIS")
        ->select(
            "transaksi_spp.*",
            "database_biodata_siswa.nama_lengkap",
            "verifikasi_spp.status_verifikasi",
            "database_biodata_siswa.nisn",
            "NIS.id_NIS"
            )
        ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
        ->orderBy("transaksi_spp.tahun_ajaran", "asc")
        ->orderBy("transaksi_spp.bulan", "asc")
        ->paginate(10);
        return view("SPP.verifikasi_SPP.index")->with(["data" => $verifikasi_spp]);
    }

    public function cari(Request $request)
    {
        $cari = $request->cari_siswa;
        $verifikasi_spp = verifikasi_SPP::where("status_verifikasi", 0)
        ->leftJoin("transaksi_spp", "verifikasi_spp.id_verifikasi", "=", "transaksi_spp.id_transaksi")
        ->leftJoin("spp_siswa", "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
        ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->whereNotNull("NIS.id_NIS")
        ->where("database_biodata_siswa.nama_lengkap", "like", "%".$cari."%")
        ->select(
            "transaksi_spp.*",
            "database_biodata_siswa.nama_lengkap",
            "verifikasi_spp.status_verifikasi",
            "database_biodata_siswa.nisn",
            "NIS.id_NIS"
        )
        ->orderBy("transaksi_spp.tahun_ajaran", "asc")
        ->orderBy("transaksi_spp.semester", "asc")
        ->orderBy("transaksi_spp.bulan", "asc")
        ->orderBy("database_biodata_siswa.nama_lengkap", "asc")

        ->paginate(10);
        return view("SPP.verifikasi_SPP.index")->with(["data" => $verifikasi_spp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
