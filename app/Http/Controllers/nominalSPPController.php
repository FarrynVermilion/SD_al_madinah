<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNominal_SPPRequest;
use App\Http\Requests\UpdateNominal_SPPRequest;
use App\Models\Nominal_SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class nominalSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("SPP.nominal_spp.index")->with("data", Nominal_SPP::orderBy("id_nominal", "asc")->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("SPP.nominal_spp.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNominal_SPPRequest $request)
    {
        $validated = $request->validated();
        Nominal_SPP::create([
            "nominal" => $validated["nominal"],
            "nama_bayaran" => $validated["nama_bayaran"]
        ]);
        return redirect()->route("nominal.index")->with("success", "Nominal SPP berhasil ditambahkan");

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
    public function destroy($nominal_SPP)
    {
        if(Auth::user()->role == "Admin"){
            $var = Nominal_SPP::find($nominal_SPP);
            $var->delete();
            return redirect()->route("nominal.index")->with("success", "Nominal SPP berhasil dihapus");
        }
        return redirect()->back()->with("error", "Anda tidak memiliki akses hubungi admin untuk menghapus");

    }
}
