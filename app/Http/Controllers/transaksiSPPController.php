<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi_SPPRequest;
use App\Http\Requests\UpdateTransaksi_SPPRequest;
use App\Models\jabatan;
use App\Models\Siswa;
use App\Models\transaksi_jabatan_sekolah;
use App\Models\Transaksi_SPP;
use App\Models\SPP_Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;
use App\Models\transaksi_jabatan_wali;
use App\Models\verifikasi_SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                "database_biodata_siswa.nama_lengkap")
            ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
            ->orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->paginate(10);
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
        $ketua_komite = transaksi_jabatan_wali::where("id_jabatan", 3)->first();
        $kepala_sekolah = transaksi_jabatan_sekolah::where("id_jabatan", 1)
        ->join("users", "users.id", "=", "transaksi_jabatan_sekolah.id_account")
        ->first();
        $val = Transaksi_SPP::withTrashed()->where("bulan", $validated["bulan"])
        ->where("tahun_ajaran", $validated["tahun_ajar"])->exists();
        if($val==true){
            return redirect()->route("transaksi.index")->with("errors", "Data sudah ada");
        }
        SPP_Siswa::where("status_siswa", "1")
        ->join("database_biodata_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
        ->join("nominal_spp", "nominal_spp.id_nominal", "=", "spp_siswa.id_nominal")
        ->leftJoin("potongan_spp", "potongan_spp.id_potongan", "=", "spp_siswa.id_potongan")
        ->select(
            "spp_siswa.*",
            "database_biodata_siswa.no_kk",
            "database_biodata_siswa.nama_lengkap",
            "nominal_spp.nominal",
            "potongan_spp.nominal_potongan"
        )
        // ->get();
        // return $spp;
        ->each(function ($spp) use ( $validated, $ketua_komite, $kepala_sekolah , &$test) {
            $key =$spp->no_kk.$spp->nama_lengkap;
            if (strlen($key) < 32) {
                $key = str_pad($key, 32, 0);
            }
            if (strlen($key) > 32) {
                $key = substr($key, 0, 32);
            }
            // ini unuk linux
            $encode = json_decode(shell_exec('./../kkp_cryptography "'.$key.'" "0|'.date("Y-m-d").'"'), true)["cyphertext"];
            // ini untuk windows
            // $encode = json_decode(shell_exec('./../kkp_cryptography.exe "'.$key.'" "0|'.date("Y-m-d").'"'), true)["cyphertext"];
            $a = new Transaksi_SPP();
            $a->id_spp = $spp->id_spp_siswa;
            $a->spp = $spp->nominal;
            $a->potongan = $spp->nominal_potongan === null ? "0" : $spp->nominal_potongan;
            $a->bulan=$validated["bulan"];
            $a->semester=$validated["semester"];
            $a->tahun_ajaran=$validated["tahun_ajar"];
            $a->status_lunas=json_encode($encode);
            $a->id_ketua_komite=$ketua_komite->id_transaksi_jabatan_wali??null;
            $a->nama_ketua_komite=$ketua_komite->nama_wali??null;
            $a->id_kepala_sekolah=$kepala_sekolah->id_transaksi_jabatan_sekolah??null;
            $a->kepala_sekolah=$kepala_sekolah->name??null;

            DB::transaction(function() use ($a, $test) {
                $a->save();
                $c = new verifikasi_SPP();
                $c->id_transaksi = $a->id_transaksi;
                $c->status_verifikasi = 0;
                $c->save();
            });
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
        //ini unuk linux
        $encode = json_decode(shell_exec('./../kkp_cryptography "'.$key.'" "1|'.date("Y-m-d").'"'), true)["cyphertext"];
        // // ini untuk windows
        // $encode = json_decode(shell_exec('./../kkp_cryptography.exe "'.$key.'" "1|'.date("Y-m-d").'"'), true)["cyphertext"];
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
                "database_biodata_siswa.nama_lengkap")->paginate(10);
        return view("SPP.transaksi_spp.index")->with(["data" => $data, "cari_siswa" => $cari]);
    }
}
