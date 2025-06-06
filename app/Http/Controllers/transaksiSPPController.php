<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi_SPPRequest;
use App\Http\Requests\UpdateTransaksi_SPPRequest;
use App\Models\Siswa;
use App\Models\Transaksi_SPP;
use App\Models\SPP_Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;
use Illuminate\Http\Request;

class transaksiSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi_SPP::join("spp_siswa", "spp_siswa.id_spp_siswa", "=", "transaksi_spp.id_spp")
            ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap")->get();
        return view("SPP.transaksi_spp.index")->with("data", $data);
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
        // $raw = shell_exec('./../kkp_cryptography "12345678123456781234567812345678" "0|'.date("Y-m-d").'"');
        // $a =json_decode($raw, true);
        // return $a["cyphertext"];
        SPP_Siswa::where("status_siswa", "1")
        ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
        ->join("nominal_spp", "nominal_spp.id_nominal", "=", "spp_siswa.id_nominal")
        ->leftJoin("potongan_spp", "potongan_spp.id_potongan", "=", "spp_siswa.id_potongan")
        ->select(
            "spp_siswa.*",
            "database_biodata_siswa.no_kk",
            "nominal_spp.nominal",
            "potongan_spp.nominal_potongan"
        )
        // ->get();
        // return $spp;
        ->each(function ($spp) use ($validated) {
            $key = $spp->no_kk.$spp->nama_lengkap;
            if (strlen($key) < 32) {
                $key = str_pad($key, 32, 0);
            }
            if (strlen($key) > 32) {
                $key = substr($key, 0, 32);
            }
            $encode = json_decode(shell_exec('./../kkp_cryptography "'.$key.'" "0|'.date("Y-m-d").'"'), true)["cyphertext"];
            Transaksi_SPP::create([
                "id_spp" => $spp->id_spp_siswa,
                "spp" => $spp->nominal,
                'potongan' => $spp->nominal_potongan === null ? "0" : $spp->nominal_potongan,
                'bulan'=>$validated["bulan"],
                'semester'=>$validated["semester"],
                'tahun_ajaran'=>$validated["tahun_ajar"],
                'status_lunas'=>json_encode($encode),
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
    public function edit($transaksi_SPP)
    {
        $transaksi_SPP = Transaksi_SPP::find($transaksi_SPP);
        $siswa = Siswa::find(SPP_Siswa::find($transaksi_SPP->id_spp)->id_siswa);
        $key = $siswa->no_kk.$siswa->nama_lengkap;
        if (strlen($key) < 32) {
            $key = str_pad($key, 32, 0);
        }
        if (strlen($key) > 32) {
            $key = substr($key, 0, 32);
        }
        $encode = json_decode(shell_exec('./../kkp_cryptography "'.$key.'" "1|'.date("Y-m-d").'"'), true)["cyphertext"];
        $transaksi_SPP->status_lunas = json_encode($encode);
        $transaksi_SPP->save();
        $transaksi_SPP->delete();
        return redirect()->back()->with("success", "Anda berhasil membayar transaksi");

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
    public function destroy($transaksi_SPP)
    {
        $transaksi_SPP = Transaksi_SPP::find($transaksi_SPP);
        $transaksi_SPP->delete();
        return redirect()->route("transaksi.index")->with("success", "Anda berhasil menghapus transaksi");
    }
    public function cari(Request $request)
    {
        $cari = $request->cari_siswa;
        $data = Transaksi_SPP::join("spp_siswa", "spp_siswa.id_spp_siswa", "=", "transaksi_spp.id_spp")
            ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
            ->where("database_biodata_siswa.nama_lengkap", "LIKE", "%".$cari."%")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap")->get();
        return view("SPP.transaksi_spp.index")->with("data", $data);
    }
}
