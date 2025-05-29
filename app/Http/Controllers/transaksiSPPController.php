<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi_SPPRequest;
use App\Http\Requests\UpdateTransaksi_SPPRequest;
use App\Models\Siswa;
use App\Models\Transaksi_SPP;
use App\Models\SPP_Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;

class transaksiSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("SPP.transaksi_spp.index")->with("data", Transaksi_SPP::all());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("SPP.transaksi_spp.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksi_SPPRequest $request)
    {
        //ketua komite dam kepala sekolah nanti dibuat setelah penggabungan aplikasi SPP utama selesai kkp karena bukan bagian SPP
        $validated = $request->validated();

        $encode = passthru("./kkp_cryptography 12345678123456781234567812345678 test");
        $spp = SPP_Siswa::where("status_siswa", "Aktif")
        ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
        ->join("nominal_spp", "nominal_spp.id_nominal", "=", "spp_siswa.id_nominal")
        ->leftJoin("potongan_spp", "potongan_spp.id_potongan", "=", "spp_siswa.id_potongan")
        ->select(
            "spp_siswa.*",
            "nominal_spp.nominal",
            "potongan_spp.nominal_potongan"
        )
        // ->get();
        // return $spp;
        ->each(function ($spp) use ($validated) {
            $key = $spp->no_kk.$spp->nama_lengkap;
            if ($key.lessThan(32)) {
                $key = str_pad($key, 32, 0);
            }
            if ($key.greaterThan(32)) {
                $key = substr($key, 0, 32);
            }
            $encode = passthru('./kkp_cryptography "'.$key.'" "0|'.date("Y-m-d").'"');
            Transaksi_SPP::create([
                "id_spp" => $spp->id,
                "spp" => $spp->nominal,
                'potongan'=>$spp->nominal_potongan,
                'bulan'=>$validated["bulan"],
                'tahun_ajaran'=>$validated["tahun_ajar"],
                'status_lunas'=>$encode,
                // 'id_ketua_komite',
                // 'nama_ketua_komite',
                // 'id_kepala_sekolah',
                // 'kepala_sekolah'
            ]);
        });

        return redirect()->route("transaksi.index")->with("success", "Anda membuat berhasil membuat transaksi");
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi_SPP $transaksi_SPP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi_SPP $transaksi_SPP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksi_SPPRequest $request, Transaksi_SPP $transaksi_SPP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi_SPP $transaksi_SPP)
    {
        //
    }
}
