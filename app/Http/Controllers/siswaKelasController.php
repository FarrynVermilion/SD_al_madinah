<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa_Kelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Siswa_NIS;
use Illuminate\Support\Facades\DB;

class siswaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $NotHaveKelas = Siswa::whereNotIn('id', Siswa_Kelas::pluck('id_siswa'))
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->orderBy('nama_lengkap', 'asc')
        ->paginate(10);
        $HaveKelas = Siswa_Kelas::leftJoin('database_biodata_siswa', 'siswa_kelas.id_siswa', '=','database_biodata_siswa.id' )
        ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
        ->leftJoin('NIS', 'database_biodata_siswa.id', '=', 'NIS.id_siswa')
        ->select(
            'database_biodata_siswa.id',
            'database_biodata_siswa.nisn',
            'database_biodata_siswa.nama_lengkap',
            'kelas.nama_kelas',
            'siswa_kelas.tahun_ajaran',
            "NIS.id_NIS"
        )->get();
        $kelas = Kelas::all();
        return view("pendaftaran.siswa_kelas.index")->with(["HaveKelas" => $HaveKelas, "kelas" => $kelas, "NotHaveKelas" => $NotHaveKelas]);
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
        $validate = $request->validate([
            "id_siswa" => "required",
            "id_kelas" => [
                "required",
                "exists:kelas,id_kelas",
                function ($attribute, $value, $fail) use ($request) {
                    if (Siswa_Kelas::withTrashed()->where('id_kelas', $value)
                        ->where('id_siswa', $request->id_siswa)
                        ->where('tahun_ajaran', $request->tahun_ajaran)
                        ->exists()) {
                        $fail('The selected class is already assigned to this student.');
                    }
                }],
            'tahun_ajaran' => 'required',
            "nis" => "required|unique:NIS,id_NIS|min:7|max:7"
        ]);
        DB::transaction(function () use ($validate) {
            Siswa_Kelas::create([
                "id_siswa" => $validate['id_siswa'],
                "id_kelas" => $validate['id_kelas'],
                "tahun_ajaran" => $validate['tahun_ajaran']
            ]);
            Siswa_NIS::create([
                "id_NIS" => $validate['nis'],
                "id_siswa" => $validate['id_siswa'],
            ]);
        });
        return redirect()->back()->with("success", "Data Berhasil Ditambah");
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
        //
    }
    public function naik_kelas(Request $request)
    {
        $validate = $request->validate([
            "id_siswa" => "required",
            "id_kelas" => ["required", "exists:kelas,id_kelas"],
            "tahun_ajaran" => "required"
        ]);
        DB::beginTransaction();
        try {
            foreach ($validate['id_siswa'] as $id) {
                if (Siswa_Kelas::withTrashed()
                    ->where('id_kelas', $validate['id_kelas'])
                    ->where('id_siswa', $id)
                    ->where('tahun_ajaran', $validate['tahun_ajaran'])
                    ->exists()) {
                    throw new \Exception();
                }
                Siswa_Kelas::where('id_siswa', $id)->delete();
                Siswa_Kelas::create([
                    "id_siswa" => $id,
                    "id_kelas" => $validate['id_kelas'],
                    "tahun_ajaran" => $validate['tahun_ajaran']
                ]);
            }

        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", "The selected class is already assigned to this student.");
        }
        DB::commit();
        return redirect()->back()->with("success", "Data Berhasil Ditambah");
    }
}
