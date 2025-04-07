<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNominal_SPPRequest;
use App\Http\Requests\UpdateNominal_SPPRequest;
use App\Models\Nominal_SPP;

class nominalSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("SPP.nominal_spp.index")->with("data", Nominal_SPP::all());
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
    public function store(StoreNominal_SPPRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Nominal_SPP $nominal_SPP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nominal_SPP $nominal_SPP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNominal_SPPRequest $request, Nominal_SPP $nominal_SPP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nominal_SPP $nominal_SPP)
    {
        //
    }
}
