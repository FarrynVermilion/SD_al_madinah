<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorejabatanRequest;
use App\Http\Requests\UpdatejabatanRequest;
use App\Models\jabatan;
use App\Models\transaksi_jabatan_sekolah;
use App\Models\transaksi_jabatan_wali;
use App\Models\User;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolah = transaksi_jabatan_sekolah::join("jabatan as a", "transaksi_jabatan_sekolah.id_jabatan", "=", "a.id_jabatan")
        ->join("users as b", "b.id", "=", "id_account")
        ->select(
            "transaksi_jabatan_sekolah.*",
            "a.nama_jabatan",
            "b.name",
            "b.role"
            )
        ->orderBy("a.nama_jabatan", "asc")
        ->paginate(10);
        $wali = transaksi_jabatan_wali::join("jabatan as a", "transaksi_jabatan_wali.id_jabatan", "=", "a.id_jabatan")
        ->select("transaksi_jabatan_wali.*","a.nama_jabatan")
        ->orderBy("a.nama_jabatan", "asc")
        ->paginate(10);
        $empty = jabatan::whereNotIn('id_jabatan', transaksi_jabatan_sekolah::pluck('id_jabatan'))
        ->whereNotIn('id_jabatan', transaksi_jabatan_wali::pluck('id_jabatan'))
        ->paginate(10);
        $users = User::whereIn('role', ['0', '1', '2'])->get();
        return view("jabatan.index")->with(["sekolah" => $sekolah, "wali" => $wali, "empty" => $empty, "users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("jabatan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorejabatanRequest $request)
    {
        $validated = $request->validated();
        jabatan::create([
            "nama_jabatan" => $validated["nama_jabatan"],
            "jenis_jabatan" => $validated["jenis_jabatan"]
        ]);
        return redirect()->route("jabatan.index")->with("success", "Jabatan berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function insert( Request $request , jabatan $jabatan)
    {
        if($jabatan->jenis_jabatan == 0){
            transaksi_jabatan_sekolah::create([
                "id_jabatan" => $jabatan->id_jabatan,
                "id_account" => $request->nama
            ]);
        }else{
            transaksi_jabatan_wali::create([
                "id_jabatan" => $jabatan->id_jabatan,
                "nama_wali" => $request->nama
            ]);
        }
        return redirect()->back()->with("success", "Jabatan berhasil ditambahkan");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejabatanRequest $request, jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jabatan $jabatan)
    {
        if($jabatan->id_jabatan == 1||$jabatan->id_jabatan == 3){
            return redirect()->back()->with("error", "Jabatan tidak boleh dihapus");
        }
        $jabatan->delete();
        return redirect()->back()->with("success", "Jabatan berhasil dihapus");
    }
    public function jabatan_pengajar_destroy(Request $request){
        $jabatan_sekolah = transaksi_jabatan_sekolah::find($request->id_transaksi_jabatan_sekolah)->first();
        $jabatan_sekolah->delete();
        return redirect()->back()->with("success", "Jabatan sekolah berhasil dicopot");
    }
    public function jabatan_wali_destroy(Request $request){
        $jabatan_sekolah = transaksi_jabatan_wali::find($request->id_transaksi_jabatan_wali)->first();
        $jabatan_sekolah->delete();
        return redirect()->back()->with("success", "Jabatan sekolah berhasil dicopot");
    }

}
