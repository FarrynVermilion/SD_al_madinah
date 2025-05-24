<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSPP_SiswaRequest;
use App\Http\Requests\UpdateSPP_SiswaRequest;
use App\Models\SPP_Siswa;
use App\Models\Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SPPSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))->orderBy('nama_lengkap', 'asc')->paginate(10);
        $data2 = SPP_Siswa::where('status_siswa', "=",1)
        ->join('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
        ->join('nominal_spp', 'nominal_spp.id_nominal', '=', 'spp_siswa.id_nominal')
        ->leftJoin('potongan_spp', 'potongan_spp.id_potongan', '=', 'spp_siswa.id_potongan')
        ->select('database_biodata_siswa.nama_lengkap',
        'database_biodata_siswa.id',
        'nominal_spp.nama_bayaran',
        'nominal_spp.nominal',
        'potongan_spp.nama_potongan',
        'potongan_spp.nominal_potongan',
        'spp_siswa.*')
        ->paginate(10);
        return view("SPP.spp_siswa.index")->with(["data1" => $data1, "data2" => $data2]);
    }
    public function cari(Request $request)
    {
        $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))->orderBy('nama_lengkap', 'asc')->paginate(10);
        $data2 = SPP_Siswa::where('status_siswa', 0)->paginate(10);
        if ($request->has('cari_siswa')) {
            $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))->where('id',"LIKE", "%".$request->cari_siswa."%")->orderBy('nama_lengkap', 'asc')->paginate(10);
        }
        if ($request->has('cari_siswa_aktif')) {
            $data2 = SPP_Siswa::where('status_siswa', 1)->where('id_siswa',"LIKE", "%".$request->cari_siswa_aktif."%")
            ->join('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
            ->paginate(10);
        }
        return view("SPP.spp_siswa.index")->with(["data1" => $data1, "data2" => $data2, "cari_siswa" => $request->cari_siswa, "cari_siswa_aktif" => $request->cari_siswa_aktif]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function create_spp($request)
    {
        $id_siswa = $request;
        $nominal_spp = Nominal_SPP::all();
        $potongan_spp = Potongan_SPP::all();
        return view("SPP.spp_siswa.create")->with(["id_siswa" => $id_siswa, "nominal_spp" => $nominal_spp, "potongan_spp" => $potongan_spp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSPP_SiswaRequest $request)
    {
        $validated = $request->validated();
        if ($validated["Potongan_SPP"]==-1) {
            $validated["Potongan_SPP"] = null;
        }
        SPP_Siswa::create([
            "id_siswa" => $validated["id_siswa"],
            "id_nominal" => $validated["Nominal_SPP"],
            "id_potongan" => $validated["Potongan_SPP"],
            "status_siswa" => 1,
        ]);
        // return $validated;
        return redirect()->route("SPPsiswa.index")->with("success_create", "SPP Siswa berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(SPP_Siswa $sPP_Siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SPP_Siswa $sPP_Siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSPP_SiswaRequest $request, SPP_Siswa $sPP_Siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SPP_Siswa $sPP_Siswa)
    {
        //
    }
}
