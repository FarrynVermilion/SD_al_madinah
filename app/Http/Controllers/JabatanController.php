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
        ->select("transaksi_jabatan_sekolah.*","a.*", "b.*")
        ->orderBy("a.nama_jabatan", "asc")
        // ->paginate(10)
        ->get();
        $wali = transaksi_jabatan_wali::join("jabatan as a", "transaksi_jabatan_wali.id_jabatan", "=", "a.id_jabatan")
        ->select("transaksi_jabatan_wali.*","a.*")
        ->orderBy("a.nama_jabatan", "asc")
        // ->paginate(10)
        ->get();
        $empty = jabatan::whereNotIn('id_jabatan', transaksi_jabatan_sekolah::pluck('id_jabatan'))
        ->whereNotIn('id_jabatan', transaksi_jabatan_wali::pluck('id_jabatan'))
        // ->paginate(10)
        ->get();
        $users = User::where("role", "Admin")->get();
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
        return ["jabatan" => $jabatan,"request" => $request->all()];
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
        //
    }
}
