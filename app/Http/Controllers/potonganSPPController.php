<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePotongan_SPPRequest;
use App\Http\Requests\UpdatePotongan_SPPRequest;
use App\Models\Potongan_SPP;
use Illuminate\Support\Facades\Auth;
class potonganSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("SPP.potongan_spp.index")->with("data", Potongan_SPP::orderBy("id_potongan", "asc")->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("SPP.potongan_spp.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePotongan_SPPRequest $request)
    {
        $validated = $request->validated();
        Potongan_SPP::create([
            "nominal_potongan" => $validated["nominal_potongan"],
            "nama_potongan" => $validated["nama_potongan"]
        ]);
        return redirect()->route("potongan.index")->with("success", "Potongan SPP berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Potongan_SPP $potongan_SPP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Potongan_SPP $potongan_SPP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePotongan_SPPRequest $request, Potongan_SPP $potongan_SPP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($potongan_SPP)
    {
        if(Auth::user()->role == "Admin"){

            $potongan = Potongan_SPP::find($potongan_SPP);
            $potongan->delete();
            return redirect()->route("potongan.index")->with("success", "Potongan SPP berhasil dihapus");
        }
        return redirect()->back()->with("error", "Anda tidak memiliki akses hubungi admin untuk menghapus");
    }
}
