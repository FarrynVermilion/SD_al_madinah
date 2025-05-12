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


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table("database_biodata_siswa AS siswa")
        ->select(
            "siswa.*",
            "wali.nama_wali",
            'wali,id AS wali_id')
            ->join('database_biodata_wali_siswa AS wali','id_siswa','=','siswa.id')
            ->orderBy('','desc')->paginate(10);
        return view("pendaftaran.siswa.index", ["data"=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pendaftaran.siswa.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request)
    {



        $email = request("email");
        $nama_lengkap = request("nama_lengkap");
        $nama_panggilan = request("nama_panggilan");
        $jenis_kelamin = request("jenis_kelamin");
        $tempat_lahir = request("tempat_lahir");
        $tanggal_lahir = request("tanggal_lahir");
        $agama = request("agama");
        $kewarganegaraan = request("kewarganegaraan");
        $anak_ke = request("anak_ke");
        $jumlah_saudara_kandung = request("jumlah_saudara_kandung");
        $jumlah_saudara_tiri = request("jumlah_saudara_tiri");
        $jumlah_saudara_angkat = request("jumlah_saudara_angkat");
        $status_anak = request("status_anak");
        $bahasa_sehari_hari = request("bahasa_sehari_hari");
        $alamat =request("alamat");
        $no_kk = request("no_kk");
        $kelurahan = request("kelurahan");
        $kecamatan = request("kecamatan");
        $kota = request("kota");
        $kode_pos = request("kode_pos");
        $nomor_telepon = request("nomor_telepon");
        $tempat_alamat = request("tempat_alamat");
        $nama_pemilik_tempat_alamat = request("nama_pemilik_tempat_alamat");
        $jarak_ke_sekolah = request("jarak_ke_sekolah");
        $metode_transportasi = request("metode_transportasi");
        $golongan_darah = request("golongan_darah");
        $riwayat_rawat = request("riwayat_rawat");
        $kelainan_jasmani = request("kelainan_jasmani");
        $tinggi_badan = request("tinggi_badan");
        $berat_badan = request("berat_badan");
        $nama_sekolah_asal = request("nama_sekolah_asal");
        $tanggal_ijazah = request("tanggal_ijazah");
        $nomor_ijazah = request("nomor_ijazah");
        $tanggal_skhun = request("tanggal_skhun");
        $nomor_skhun = request("nomor_skhun");
        $lama_belajar = request("lama_belajar");
        $nisn = request("nisn");
        $tipe_riwayat_sekolah = request("tipe_riwayat_sekolah");
        $nama_riwayat_sekolah = request("nama_riwayat_sekolah");
        $tanggal_pindah = request("tanggal_pindah");
        $alasan_pindah = request("alasan_pindah");

        $user =user::create([
            'name' => $nama_lengkap,
            'email' => $email,
            'password' => Hash::make("P".$tanggal_lahir),
            'role' => 3
        ]);
        // Create the Siswa record
        $siswa = new Siswa();
        $siswa->id_account = $user->id;
        $siswa->nama_lengkap = request("nama_lengkap") ?? null;
        $siswa->nama_panggilan = request("nama_panggilan") ?? null;
        $siswa->jenis_kelamin = request("jenis_kelamin") ?? null;
        $siswa->tempat_lahir = request("tempat_lahir") ?? null;
        $siswa->tanggal_lahir = request("tanggal_lahir") ?? null;
        $siswa->agama = request("agama") ?? null;
        $siswa->kewarganegaraan = request("kewarganegaraan") ?? null;
        $siswa->anak_ke = request("anak_ke") ?? null;
        $siswa->jumlah_saudara_kandung = request("jumlah_saudara_kandung") ?? null;
        $siswa->jumlah_saudara_tiri = request("jumlah_saudara_tiri") ?? null;
        $siswa->jumlah_saudara_angkat = request("jumlah_saudara_angkat") ?? null;
        $siswa->status_anak = request("status_anak") ?? null;
        $siswa->bahasa_sehari_hari = request("bahasa_sehari_hari") ?? null;
        $siswa->alamat = request("alamat") ?? null;
        $siswa->no_kk = request("no_kk") ?? null;
        $siswa->kelurahan = request("kelurahan") ?? null;
        $siswa->kecamatan = request("kecamatan") ?? null;
        $siswa->kota = request("kota") ?? null;
        $siswa->kode_pos = request("kode_pos") ?? null;
        $siswa->nomor_telepon = request("nomor_telepon") ?? null;
        $siswa->tempat_alamat = request("tempat_alamat") ?? null;
        $siswa->nama_pemilik_tempat_alamat = request("nama_pemilik_tempat_alamat") ?? null;
        $siswa->jarak_ke_sekolah = request("jarak_ke_sekolah") ?? null;
        $siswa->metode_transportasi = request("metode_transportasi") ?? null;
        $siswa->golongan_darah = request("golongan_darah") ?? null;
        $siswa->riwayat_rawat = request("riwayat_rawat") ?? null;
        $siswa->riwayat_penyakit = request("riwayat_penyakit") ?? null;
        $siswa->kelainan_jasmani = request("kelainan_jasmani") ?? null;
        $siswa->tinggi_badan = request("tinggi_badan") ?? null;
        $siswa->berat_badan = request("berat_badan") ?? null;
        $siswa->nama_sekolah_asal = request("nama_sekolah_asal") ?? null;
        $siswa->tanggal_ijazah = request("tanggal_ijazah") ?? null;
        $siswa->nomor_ijazah = request("nomor_ijazah") ?? null;
        $siswa->tanggal_skhun = request("tanggal_skhun") ?? null;
        $siswa->nomor_skhun = request("nomor_skhun") ?? null;
        $siswa->lama_belajar = request("lama_belajar") ?? null;
        $siswa->nisn = request("nisn") ?? null;
        $siswa->tipe_riwayat_sekolah = request("tipe_riwayat_sekolah") ?? null;
        $siswa->nama_riwayat_sekolah = request("nama_riwayat_sekolah") ?? null;
        $siswa->tanggal_pindah = request("tanggal_pindah") ?? null;
        $siswa->alasan_pindah = request("alasan_pindah") ?? null;
        $siswa->save();

        $wali = new Wali_Siswa();
        $wali->id_siswa = $siswa->id;
        $wali->nama_ayah = request("nama_ayah") ?? null;
        $wali->nama_ibu = request("nama_ibu") ?? null;
        $wali->tempat_lahir_ayah = request("tempat_lahir_ayah") ?? null;
        $wali->tempat_lahir_ibu = request("tempat_lahir_ibu") ?? null;
        $wali->tanggal_lahir_ayah = request("tanggal_lahir_ayah") ?? null;
        $wali->tanggal_lahir_ibu = request("tanggal_lahir_ibu") ?? null;
        $wali->kewarganegaraan_ayah = request("kewarganegaraan_ayah") ?? null;
        $wali->kewarganegaraan_ibu = request("kewarganegaraan_ibu") ?? null;
        $wali->nik_ayah = request("nik_ayah") ?? null;
        $wali->nik_ibu = request("nik_ibu") ?? null;
        $wali->agama_ayah = request("agama_ayah") ?? null;
        $wali->agama_ibu = request("agama_ibu") ?? null;
        $wali->pendidikan_ayah = request("pendidikan_ayah") ?? null;
        $wali->pendidikan_ibu = request("pendidikan_ibu") ?? null;
        $wali->ijazah_ayah = request("ijazah_ayah") ?? null;
        $wali->ijazah_ibu = request("ijazah_ibu") ?? null;
        $wali->pekerjaan_ayah = request("pekerjaan_ayah") ?? null;
        $wali->pekerjaan_ibu = request("pekerjaan_ibu") ?? null;
        $wali->penghasilan_ayah = request("penghasilan_ayah") ?? null;
        $wali->penghasilan_ibu = request("penghasilan_ibu") ?? null;
        $wali->alamat_kerja_ayah = request("alamat_kerja_ayah") ?? null;
        $wali->alamat_kerja_ibu = request("alamat_kerja_ibu") ?? null;
        $wali->alamat_rumah_ayah = request("alamat_rumah_ayah") ?? null;
        $wali->alamat_rumah_ibu = request("alamat_rumah_ibu") ?? null;
        $wali->status_hidup = request("status_hidup") ?? null;
        $wali->nama_wali = request("nama_wali") ?? null;
        $wali->tempat_lahir_wali = request("tempat_lahir_wali") ?? null;
        $wali->tanggal_lahir_wali = request("tanggal_lahir_wali") ?? null;
        $wali->kewarganegaraan_wali = request("kewarganegaraan_wali") ?? null;
        $wali->nik_wali = request("nik_wali") ?? null;
        $wali->agama_wali = request("agama_wali") ?? null;
        $wali->hubungan_keluarga = request("hubungan_keluarga") ?? null;
        $wali->ijazah_wali = request("ijazah_wali") ?? null;
        $wali->pekerjaan_wali = request("pekerjaan_wali") ?? null;
        $wali->penghasilan_wali = request("penghasilan_wali") ?? null;
        $wali->alamat_rumah_wali = request("alamat_rumah_wali") ?? null;
        $wali->nomor_telp_wali = request("nomor_telp_wali") ?? null;
        $wali->save();




        return $request;
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
    public function destroy(Siswa $siswa)
    {
        //
    }
}
