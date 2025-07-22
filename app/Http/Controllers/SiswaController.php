<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Array_;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table("database_biodata_siswa AS siswa")
        ->leftJoin('database_biodata_wali_siswa AS wali','siswa.NO_KK','=','wali.NO_KK')
        ->whereNull('siswa.deleted_at')
        ->select("siswa.*","wali.*")
        ->orderBy('siswa.id','desc')->paginate(10);
        return view("pendaftaran.siswa.index", ["data"=> $data]);
    }
    public function cari(Request $request)
    {
        $request->validate([
            'cari' => 'required'
        ]);
        $cari = $request->cari;
        $data = DB::table("database_biodata_siswa AS siswa")
        ->leftJoin('database_biodata_wali_siswa AS wali','siswa.NO_KK','=','wali.NO_KK')
        ->whereNull('siswa.deleted_at')
        ->select("siswa.*","wali.*")
        ->where('siswa.nama_lengkap',"LIKE", "%".$cari."%")
        ->orderBy('siswa.id','desc')->paginate(10);
        return view("pendaftaran.siswa.index", ["data"=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $kk = Wali_Siswa::all()->select('NO_KK')->pluck('NO_KK')->toArray();
        return view("pendaftaran.siswa.create")->with(["kk"=>$kk]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $tanggal_lahir = explode("-",$validated["tanggal_lahir"]);
            $res = "";
            for ($i = count($tanggal_lahir); $i > 0; $i--) {
                $res .= $tanggal_lahir[$i-1];
            }
            $user = User::create([
                'name' => $validated["nama_lengkap"],
                'email' => $validated["email"],
                'password' => Hash::make("P".$res),
                'role' => 3
            ]);
            $siswa = new Siswa();
            $siswa->id_account = $user->id;
            $siswa->nama_lengkap = $validated["nama_lengkap"] ?? null;
            $siswa->nama_panggilan = $validated["nama_panggilan"] ?? null;
            $siswa->jenis_kelamin = $validated["jenis_kelamin"] ?? null;
            $siswa->tempat_lahir = $validated["tempat_lahir"] ?? null;
            $siswa->tanggal_lahir = $validated["tanggal_lahir"] ?? null;
            $siswa->agama = $validated["agama"] ?? null;
            $siswa->kewarganegaraan = $validated["kewarganegaraan"] ?? null;
            $siswa->anak_ke = $validated["anak_ke"] ?? null;
            $siswa->jumlah_saudara_kandung = $validated["jumlah_saudara_kandung"] ?? null;
            $siswa->jumlah_saudara_tiri = $validated["jumlah_saudara_tiri"] ?? null;
            $siswa->jumlah_saudara_angkat = $validated["jumlah_saudara_angkat"] ?? null;
            $siswa->status_anak = $validated["status_anak"] ?? null;
            $siswa->bahasa_sehari_hari = $validated["bahasa_sehari_hari"] ?? null;
            $siswa->alamat = $validated["alamat"] ?? null;
            $siswa->kelurahan = $validated["kelurahan"] ?? null;
            $siswa->kecamatan = $validated["kecamatan"] ?? null;
            $siswa->kota = $validated["kota"] ?? null;
            $siswa->kode_pos = $validated["kode_pos"] ?? null;
            $siswa->nomor_telepon = $validated["nomor_telepon"] ?? null;
            $siswa->tempat_alamat = $validated["tempat_alamat"] ?? null;
            $siswa->nama_pemilik_tempat_alamat = $validated["nama_pemilik_tempat_alamat"] ?? null;
            $siswa->jarak_ke_sekolah = $validated["jarak_ke_sekolah"] ?? null;
            $siswa->metode_transportasi = $validated["metode_transportasi"] ?? null;
            $siswa->golongan_darah = $validated["golongan_darah"] ?? null;
            $siswa->riwayat_rawat = $validated["riwayat_rawat"] ?? null;
            $siswa->riwayat_penyakit = $validated["riwayat_penyakit"] ?? null;
            $siswa->kelainan_jasmani = $validated["kelainan_jasmani"] ?? null;
            $siswa->tinggi_badan = $validated["tinggi_badan"] ?? null;
            $siswa->berat_badan = $validated["berat_badan"] ?? null;
            $siswa->nama_sekolah_asal = $validated["nama_sekolah_asal"] ?? null;
            $siswa->tanggal_ijazah = $validated["tanggal_ijazah"] ?? null;
            $siswa->nomor_ijazah = $validated["nomor_ijazah"] ?? null;
            $siswa->tanggal_skhun = $validated["tanggal_skhun"] ?? null;
            $siswa->nomor_skhun = $validated["nomor_skhun"] ?? null;
            $siswa->lama_belajar = $validated["lama_belajar"] ?? null;
            $siswa->nisn = $validated["nisn"] ?? null;
            $siswa->tipe_riwayat_sekolah = $validated["tipe_riwayat_sekolah"] ?? null;
            $siswa->nama_riwayat_sekolah = $validated["nama_riwayat_sekolah"] ?? null;
            $siswa->tanggal_pindah = $validated["tanggal_pindah"] ?? null;
            $siswa->alasan_pindah = $validated["alasan_pindah"] ?? null;
            $siswa->NO_KK = $validated["no_kk"] ?? null;
            $siswa->save();

            if ($validated["pilih_data_kk"] == 0) {
                $wali = new Wali_Siswa();
                $wali->NO_KK = $validated["no_kk"] ?? null;
                $wali->nama_ayah = $validated["nama_ayah"] ?? null;
                $wali->nama_ibu = $validated["nama_ibu"] ?? null;
                $wali->tempat_lahir_ayah = $validated["tempat_lahir_ayah"] ?? null;
                $wali->tempat_lahir_ibu = $validated["tempat_lahir_ibu"] ?? null;
                $wali->tanggal_lahir_ayah = $validated["tanggal_lahir_ayah"] ?? null;
                $wali->tanggal_lahir_ibu = $validated["tanggal_lahir_ibu"] ?? null;
                $wali->kewarganegaraan_ayah = $validated["kewarganegaraan_ayah"] ?? null;
                $wali->kewarganegaraan_ibu = $validated["kewarganegaraan_ibu"] ?? null;
                $wali->nik_ayah = $validated["nik_ayah"] ?? null;
                $wali->nik_ibu = $validated["nik_ibu"] ?? null;
                $wali->agama_ayah = $validated["agama_ayah"] ?? null;
                $wali->agama_ibu = $validated["agama_ibu"] ?? null;
                $wali->pendidikan_ayah = $validated["pendidikan_ayah"] ?? null;
                $wali->pendidikan_ibu = $validated["pendidikan_ibu"] ?? null;
                $wali->ijazah_ayah = $validated["ijazah_ayah"] ?? null;
                $wali->ijazah_ibu = $validated["ijazah_ibu"] ?? null;
                $wali->pekerjaan_ayah = $validated["pekerjaan_ayah"] ?? null;
                $wali->pekerjaan_ibu = $validated["pekerjaan_ibu"] ?? null;
                $wali->penghasilan_ayah = $validated["penghasilan_ayah"] ?? null;
                $wali->penghasilan_ibu = $validated["penghasilan_ibu"] ?? null;
                $wali->alamat_kerja_ayah = $validated["alamat_kerja_ayah"] ?? null;
                $wali->alamat_kerja_ibu = $validated["alamat_kerja_ibu"] ?? null;
                $wali->alamat_rumah_ayah = $validated["alamat_rumah_ayah"] ?? null;
                $wali->alamat_rumah_ibu = $validated["alamat_rumah_ibu"] ?? null;
                $wali->status_hidup = $validated["status_hidup"] ?? null;
                $wali->nama_wali = $validated["nama_wali"] ?? null;
                $wali->tempat_lahir_wali = $validated["tempat_lahir_wali"] ?? null;
                $wali->tanggal_lahir_wali = $validated["tanggal_lahir_wali"] ?? null;
                $wali->kewarganegaraan_wali = $validated["kewarganegaraan_wali"] ?? null;
                $wali->nik_wali = $validated["nik_wali"] ?? null;
                $wali->agama_wali = $validated["agama_wali"] ?? null;
                $wali->hubungan_keluarga = $validated["hubungan_keluarga"] ?? null;
                $wali->ijazah_wali = $validated["ijazah_wali"] ?? null;
                $wali->pekerjaan_wali = $validated["pekerjaan_wali"] ?? null;
                $wali->penghasilan_wali = $validated["penghasilan_wali"] ?? null;
                $wali->alamat_rumah_wali = $validated["alamat_rumah_wali"] ?? null;
                $wali->nomor_telp_wali = $validated["nomor_telp_wali"] ?? null;
                $wali->save();
            }

        });

        return redirect()->route("siswa.index",with(["success" => "Data Berhasil Disimpan"]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($siswa)
    {
        $siswa_data = Siswa::find($siswa);
        User::where('id', $siswa_data->id_account)->delete();
        // Wali_Siswa::find(Wali_Siswa::where("NO_KK", $siswa_data->NO_KK)->first()->id)->delete();
        $siswa_data->delete();
        return redirect()->back()->with("success", "Data Berhasil Dihapus");
    }
}
