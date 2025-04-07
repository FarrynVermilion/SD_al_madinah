<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSPP_SiswaRequest;
use App\Http\Requests\UpdateSPP_SiswaRequest;
use App\Models\SPP_Siswa;

class SPPSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("SPP.spp_siswa.index")->with("data", SPP_Siswa::all());
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
    public function store(StoreSPP_SiswaRequest $request)
    {
        //
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
