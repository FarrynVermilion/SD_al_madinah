<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paraf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ParafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paraf = paraf::where("created_by", Auth::user()->id)->paginate(5);
        return view("paraf.index")->with("data", $paraf);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            "paraf" => ["required", "mimetypes:image/jpeg,image/png,image/jpg,image/svg", "file","max:2048"]
        ]);
        if(paraf::where("created_by", Auth::user()->id)->exists()){
            return redirect()->route("paraf.index")->with("error", "Paraf sudah ada hapus paraf senelumnya terlebih dahulu");
        }
        $fileNameToStore = null;
        if ($request->hasFile('paraf')) {
            $filename = Auth::user()->id;
            $fileExtension = $request->file('paraf')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            Storage::putFileAs('',$request->file('paraf'),"paraf/".$fileNameToStore);
        }

        $paraf = new paraf;
        $paraf->image_paraf_path = $fileNameToStore;
        $paraf->save();
        return redirect()->route("paraf.index")->with("success", "Paraf berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Storage::download("paraf/".paraf::find($id)->image_paraf_path);
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
        $paraf = paraf::find($id);
        $paraf->delete();
        return redirect()->route("paraf.index")->with("success", "Paraf berhasil dihapus");
    }
}



