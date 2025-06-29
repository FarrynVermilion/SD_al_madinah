<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
class kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("pendaftaran.kelas.index")->with("data", Kelas::orderBy("nama_kelas", "asc")->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("pendaftaran.kelas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "kelas" => "required"
        ]);
        Kelas::create([
            "nama_kelas" => $request->kelas
        ]);
        return redirect()->route("kelas.index")->with("success","Data Berhasil Ditambah");
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
        $kelas = Kelas::find($id);
        $kelas->delete();
        return redirect()->route("kelas.index")->with("success","Data Berhasil Dihapus");
    }
}
