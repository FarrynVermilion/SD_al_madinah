<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSPP_SiswaRequest;
use App\Http\Requests\UpdateSPP_SiswaRequest;
use App\Models\SPP_Siswa;
use App\Models\Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;
use Illuminate\Http\Request;
use App\Models\Siswa_Kelas;
use App\Models\Kelas;
use App\Models\Siswa_NIS;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Http\FormRequest;

class SPPSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->leftJoinSub(
            DB::table('siswa_kelas')
            ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->whereNull('siswa_kelas.deleted_at')
            ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
            'kelas',
            'database_biodata_siswa.id',
            '=',
            'kelas.id_siswa'
        )
        ->whereNotNull("NIS.id_NIS")
        ->select(
            'database_biodata_siswa.nama_lengkap',
            'database_biodata_siswa.nisn',            'database_biodata_siswa.id',
            'NIS.id_NIS',
            'kelas.nama_kelas',
            'kelas.tahun_ajaran',
            'database_biodata_siswa.nisn',
            'database_biodata_siswa.id',
        )
        ->orderBy('nama_lengkap', 'asc')->paginate(10);
        $data2 = SPP_Siswa::leftJoin('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
        ->leftJoin('nominal_spp', 'spp_siswa.id_nominal', '=', 'nominal_spp.id_nominal')
        ->leftJoin('potongan_spp', 'potongan_spp.id_potongan', '=', 'spp_siswa.id_potongan')
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->leftJoinSub(
            DB::table('siswa_kelas')
            ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->whereNull('siswa_kelas.deleted_at')
            ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
            'kelas',
            'database_biodata_siswa.id',
            '=',
            'kelas.id_siswa'
        )
        ->whereNotNull("NIS.id_NIS")
        ->leftJoin("users as penanggung_jawab","spp_siswa.updated_by", "=", "penanggung_jawab.id")
        ->select('database_biodata_siswa.nama_lengkap',
        'database_biodata_siswa.nisn',
        'database_biodata_siswa.id',
        'nominal_spp.nama_bayaran',
        'nominal_spp.nominal',
        'potongan_spp.nama_potongan',
        'potongan_spp.nominal_potongan',
        'kelas.nama_kelas',
        'kelas.tahun_ajaran',
        'NIS.id_NIS',
        'penanggung_jawab.name as penanggung_jawab',
        'spp_siswa.*')
        ->paginate(10);
        return view("SPP.spp_siswa.index")->with(["data1" => $data1, "data2" => $data2]);
    }
    public function cari(Request $request)
    {
        $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->leftJoinSub(
            DB::table('siswa_kelas')
            ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->whereNull('siswa_kelas.deleted_at')
            ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
            'kelas',
            'database_biodata_siswa.id',
            '=',
            'kelas.id_siswa'
        )
        ->whereNotNull("NIS.id_NIS")
        ->select(
            'database_biodata_siswa.nama_lengkap',
            'database_biodata_siswa.nisn',
            'database_biodata_siswa.id',
            'NIS.id_NIS',
            'kelas.nama_kelas',
            'kelas.tahun_ajaran',
            'database_biodata_siswa.nisn',
            'database_biodata_siswa.id',
        )
        ->orderBy('nama_lengkap', 'asc')->paginate(10);
        $data2 = SPP_Siswa::leftJoin('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
        ->leftJoin('nominal_spp', 'spp_siswa.id_nominal', '=', 'nominal_spp.id_nominal')
        ->leftJoin('potongan_spp', 'potongan_spp.id_potongan', '=', 'spp_siswa.id_potongan')
        ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
        ->leftJoinSub(
            DB::table('siswa_kelas')
            ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->whereNull('siswa_kelas.deleted_at')
            ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
            'kelas',
            'database_biodata_siswa.id',
            '=',
            'kelas.id_siswa'
        )
        ->whereNotNull("NIS.id_NIS")
        ->leftJoin("users as penanggung_jawab","spp_siswa.updated_by", "=", "penanggung_jawab.id")
        ->select('database_biodata_siswa.nama_lengkap',
        'database_biodata_siswa.nisn',
        'database_biodata_siswa.id',
        'nominal_spp.nama_bayaran',
        'nominal_spp.nominal',
        'potongan_spp.nama_potongan',
        'potongan_spp.nominal_potongan',
        'kelas.nama_kelas',
        'kelas.tahun_ajaran',
        'NIS.id_NIS',
        'penanggung_jawab.name as penanggung_jawab',
        'spp_siswa.*')
        ->paginate(10);
        if ($request->has('cari_siswa')) {
            $data1 = Siswa::whereNotIn('id', SPP_Siswa::pluck('id_siswa'))
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->leftJoinSub(
                DB::table('siswa_kelas')
                ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
                ->whereNull('siswa_kelas.deleted_at')
                ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran'),
                'kelas',
                'database_biodata_siswa.id',
                '=',
                'kelas.id_siswa'
            )
            ->whereNotNull("NIS.id_NIS")
            ->select(
                'database_biodata_siswa.nama_lengkap',
                'database_biodata_siswa.id',
                'kelas.tahun_ajaran',
                'NIS.id_NIS',
                'kelas.nama_kelas',
                'database_biodata_siswa.nisn',
                'database_biodata_siswa.id',
            )
            ->where('nama_lengkap',"LIKE", "%".$request->cari_siswa."%")
            ->orderBy('nama_lengkap', 'asc')->paginate(10);
        }
        if ($request->has('cari_siswa_aktif')) {
            $data2 = SPP_Siswa::leftJoin('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
            ->leftJoin('nominal_spp', 'spp_siswa.id_nominal', '=', 'nominal_spp.id_nominal')
            ->leftJoin('potongan_spp', 'potongan_spp.id_potongan', '=', 'spp_siswa.id_potongan')
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->leftJoinSub(
                DB::table('siswa_kelas')
                ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
                ->whereNull('siswa_kelas.deleted_at')
                ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
                'kelas',
                'database_biodata_siswa.id',
                '=',
                'kelas.id_siswa'
            )
            ->whereNotNull("NIS.id_NIS")
            ->leftJoin("users as penanggung_jawab","spp_siswa.updated_by", "=", "penanggung_jawab.id")
            ->select('database_biodata_siswa.nama_lengkap',
            'database_biodata_siswa.id',
            'nominal_spp.nama_bayaran',
            'nominal_spp.nominal',
            'potongan_spp.nama_potongan',
            'potongan_spp.nominal_potongan',
            'kelas.nama_kelas',
            'kelas.tahun_ajaran',
            'NIS.id_NIS',
            'penanggung_jawab.name as penanggung_jawab',
            'spp_siswa.*')
            ->where('database_biodata_siswa.nama_lengkap',"LIKE", "%".$request->cari_siswa_aktif."%")
            ->orderBy('database_biodata_siswa.nama_lengkap', 'asc')
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
        $siswa = Siswa::where("id", "=", $request)->first();
        $nominal_spp = Nominal_SPP::all();
        $potongan_spp = Potongan_SPP::all();
        return view("SPP.spp_siswa.create")->with(["siswa" => $siswa, "nominal_spp" => $nominal_spp, "potongan_spp" => $potongan_spp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "id_siswa" => ["required", "exists:database_biodata_siswa,id", "unique:spp_siswa,id_siswa"],
            "Nominal_SPP" => "required",
            "Potongan_SPP" => "required",
            "Bukti_Potongan"=>["mimetypes:application/pdf", "file","max:2048", "nullable"]
        ]);
        if (isset($validated["Potongan_SPP"]) && $validated["Potongan_SPP"]==-1) {
            $validated["Potongan_SPP"] = null;
        }
        $fileNameToStore = null;
        if ($request->hasFile('Bukti_Potongan')) {
            $filename = "bukti_potongan_".$validated["id_siswa"];
            $fileExtension = $request->file('Bukti_Potongan')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
            Storage::putFileAs('bukti_potongan',$request->file('Bukti_Potongan'),$fileNameToStore);
        }

        SPP_Siswa::create([
            "id_siswa" => $validated["id_siswa"],
            "id_nominal" => $validated["Nominal_SPP"],
            "id_potongan" => $validated["Potongan_SPP"],
            "bukti_potongan" => $fileNameToStore,
            "status_siswa" => 1,
        ]);

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
    public function edit($SPP_Siswa)
    {
        $SPP_Siswa = SPP_Siswa::find($SPP_Siswa);
        $siswa = Siswa::where("id", "=", $SPP_Siswa->id_siswa)->first();
        $nominal_spp = Nominal_SPP::all();
        $potongan_spp = Potongan_SPP::all();
        return view("SPP.spp_siswa.update")->with(["SPP_Siswa" => $SPP_Siswa, "siswa" => $siswa, "nominal_spp" => $nominal_spp, "potongan_spp" => $potongan_spp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $SPP_Siswa)
    {
        $SPP_Siswa = SPP_Siswa::find($SPP_Siswa);
        $validated = $request->validate([
            "Nominal_SPP" => "required",
            "Potongan_SPP" => "nullable",
            "Bukti_Potongan"=>["mimetypes:application/pdf", "file","max:2048", "nullable"],
            'file_name' => ['nullable', 'string', 'max:255'],
        ]);

        $fileNameToStore = "";
        if (isset($validated["Potongan_SPP"]) && $validated["Potongan_SPP"]==-1) {
            $validated["Potongan_SPP"] = null;
            $validated["Bukti_Potongan"] = null;
        }else{
            if ($request->hasFile('Bukti_Potongan')) {
                $filename = "Bukti_Potongan".$SPP_Siswa->id_siswa;
                $fileExtension = $request->file('Bukti_Potongan')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$fileExtension;
                Storage::putFileAs('bukti_potongan',$request->file('Bukti_Potongan'),$fileNameToStore);
                $validated["Bukti_Potongan"] = $fileNameToStore;
            }
        }
        $SPP_Siswa->update([
            "id_nominal" => $validated["Nominal_SPP"],
            "id_potongan" => $validated["Potongan_SPP"],
            "bukti_potongan" => $fileNameToStore,
        ]);
        return redirect()->route("SPPsiswa.index")->with("success", "SPP Siswa berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($SPP_Siswa)
    {
        $SPP_Siswa = SPP_Siswa::find($SPP_Siswa);
        if($SPP_Siswa->status_siswa == "Aktif"){
            $SPP_Siswa->status_siswa = 0;
        }else{
            $SPP_Siswa->status_siswa = 1;
        }
        $SPP_Siswa->save();
        return redirect()->route("SPPsiswa.index")->with("success", "SPP Siswa berhasil dihapus");
    }
    public function hapus($SPP_Siswa)
    {
        $SPP_Siswa = SPP_Siswa::find($SPP_Siswa);
        $SPP_Siswa->status_siswa = 0;
        $SPP_Siswa->save();
        $SPP_Siswa->delete();
        return redirect()->route("SPPsiswa.index")->with("success", "SPP Siswa berhasil dihapus");
    }
}
