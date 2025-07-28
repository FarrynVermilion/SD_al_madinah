<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi_SPPRequest;
use App\Http\Requests\UpdateTransaksi_SPPRequest;
use App\Models\jabatan;
use App\Models\Siswa;
use App\Models\transaksi_jabatan_sekolah;
use App\Models\Transaksi_SPP;
use App\Models\SPP_Siswa;
use App\Models\Nominal_SPP;
use App\Models\Potongan_SPP;
use App\Models\transaksi_jabatan_wali;
use App\Models\User;
use App\Models\verifikasi_SPP;
use App\Models\paraf;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Exception;
use PDF;
use PhpParser\Node\Expr\Array_;

class transaksiSPPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi_SPP::leftJoin("spp_siswa",  "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->whereNotNull("NIS.id_NIS")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap",
                "database_biodata_siswa.nisn",
                "database_biodata_siswa.NO_KK",
                "NIS.id_NIS",
            )
            ->whereNull("transaksi_spp.bukti_pembayaran")
            ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
            ->orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.semester", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->paginate(10);
        foreach ($data as $d) {
            if($d->bukti_potongan != null|| trim($d->bukti_potongan) != ""||is_null($d->bukti_potongan)){
                $key =$d->NO_KK.$d->nama_lengkap;
                if (strlen($key) < 32) {
                    $key = str_pad($key, 32, 0);
                }
                if (strlen($key) > 32) {
                    $key = substr($key, 0, 32);
                }
                //linux
                $decode_potongan = shell_exec("./../kkp_decryption '".$key."' '".$d->bukti_potongan."'");
                //windows
                // $decode_potongan = shell_exec('kkp_decryption '.$key.' '.$d->bukti_potongan);
                $d->bukti_potongan =trim($decode_potongan);
            }
            $d->NO_KK = null;
        }

        $data_dengan_bukti_pembayaran = Transaksi_SPP::leftJoin("spp_siswa",  "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->whereNotNull("NIS.id_NIS")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap",
                "database_biodata_siswa.nisn",
                "database_biodata_siswa.NO_KK",
                "NIS.id_NIS",
            )
            ->whereNotNull("transaksi_spp.bukti_pembayaran")
            ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
            ->orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.semester", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->paginate(10);
        foreach ($data_dengan_bukti_pembayaran as $x) {
            if($x->bukti_potongan != null|| trim($x->bukti_potongan) != ""||is_null($x->bukti_potongan)||$x->bukti_pembayaran != null|| trim($x->bukti_pembayaran) != ""||is_null($x->bukti_pembayaran))
            {
                $key =$x->NO_KK.$x->nama_lengkap;
                if (strlen($key) < 32) {
                    $key = str_pad($key, 32, 0);
                }
                if (strlen($key) > 32) {
                    $key = substr($key, 0, 32);
                }
            }
            if($x->bukti_potongan != null|| trim($x->bukti_potongan) != ""||is_null($x->bukti_potongan)){
                //linux
                $decode_potongan = shell_exec("./../kkp_decryption '".$key."' '".$x->bukti_potongan."'");
                //windows
                // $decode_potongan = shell_exec("C:/xampp/htdocs/kkp_decryption '".$key."' '".$x->bukti_potongan."'");
                $x->bukti_potongan = trim($decode_potongan);
            }
            if($x->bukti_pembayaran != null|| trim($x->bukti_pembayaran) != ""||is_null($x->bukti_pembayaran)){
                //linux
                $decode_pembayaran = shell_exec("./../kkp_decryption '".$key."' '".$x->bukti_pembayaran."'");
                //windows
                // $decode_pembayaran = shell_exec("C:/xampp/htdocs/kkp_decryption '".$key."' '".$x->bukti_pembayaran."'");
                $x->bukti_pembayaran = trim($decode_pembayaran);
            }
            $x->NO_KK = null;
        }
        return view("SPP.transaksi_spp.index")->with(["data" => $data, "data_dengan_bukti_pembayaran" => $data_dengan_bukti_pembayaran]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = SPP_Siswa::leftJoin('database_biodata_siswa', 'database_biodata_siswa.id', '=', 'spp_siswa.id_siswa')
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
        'spp_siswa.*')
        ->orderBy('spp_siswa.bukti_potongan','asc')
        ->orderBy("NIS.id_NIS", "asc")
        ->paginate(10);
        return view("SPP.transaksi_spp.create")->with(["data" => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksi_SPPRequest $request)
    {
        //ketua komite dam kepala sekolah nanti dibuat setelah penggabungan aplikasi SPP utama selesai kkp karena bukan bagian SPP
        $validated = $request->validated();
        $ketua_komite = transaksi_jabatan_wali::where("id_jabatan", 3)->first();
        $kepala_sekolah = transaksi_jabatan_sekolah::where("id_jabatan", 1)
        ->leftJoin("users", "users.id", "=", "transaksi_jabatan_sekolah.id_account")
        ->first();
        // DB::beginTransaction();
        // try {
        //     SPP_Siswa::where("status_siswa", "1")
        //     ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=","database_biodata_siswa.id" )
        //     ->leftJoin("nominal_spp", "spp_siswa.id_nominal", "=","nominal_spp.id_nominal" )
        //     ->leftJoin("potongan_spp", "potongan_spp.id_potongan", "=", "spp_siswa.id_potongan")
        //     ->leftJoinSub(
        //             DB::table('siswa_kelas')
        //             ->leftJoin('kelas', 'siswa_kelas.id_kelas', '=', 'kelas.id_kelas')
        //             ->whereNull('siswa_kelas.deleted_at')
        //             ->select('siswa_kelas.id_kelas', 'siswa_kelas.id_siswa', 'kelas.nama_kelas as nama_kelas', 'siswa_kelas.tahun_ajaran as tahun_ajaran' ),
        //             'kelas',
        //             'database_biodata_siswa.id',
        //             '=',
        //             'kelas.id_siswa'
        //         )
        //     ->select(
        //         "spp_siswa.*",
        //         "database_biodata_siswa.no_kk",
        //         "database_biodata_siswa.nama_lengkap",
        //         "nominal_spp.nominal",
        //         "potongan_spp.nominal_potongan",
        //         "kelas.nama_kelas",
        //         "kelas.tahun_ajaran"
        //     )
        //     ->each(function ($spp) use ( $validated, $ketua_komite, $kepala_sekolah , &$test) {
        //         $key =$spp->no_kk.$spp->nama_lengkap;
        //         if (strlen($key) < 32) {
        //             $key = str_pad($key, 32, 0);
        //         }
        //         if (strlen($key) > 32) {
        //             $key = substr($key, 0, 32);
        //         }
        //         // ini unuk linux
        //         $encode = json_decode(shell_exec('./../kkp_cryptography "'.$key.'" "0|'.date("Y-m-d")."|".Auth::user()->name.'|"'), true)["cyphertext"];
        //         // ini untuk windows
        //         // $encode = json_decode(shell_exec('C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe "'.$key.'" "0|'.date("Y-m-d").'"'), true)["cyphertext"];
        //         if(Transaksi_SPP::where("id_spp", $spp->id_spp_siswa)
        //             ->where("bulan", $validated["bulan"])
        //             ->where("semester", $validated["semester"])
        //             ->where("tahun_ajaran", $spp->tahun_ajaran)
        //             ->exists()){
        //             $semester = $validated["semester"] == 0 ? "ganjil" : "genap";
        //             $bulan = "";
        //             if ($semester == "ganjil") {
        //                 switch ($validated["bulan"]) {
        //                     case "1":
        //                         $bulan = "juli";
        //                         break;
        //                     case "2":
        //                         $bulan = "agustus";
        //                         break;
        //                     case "3":
        //                         $bulan = "september";
        //                         break;
        //                     case "4":
        //                         $bulan = "oktober";
        //                         break;
        //                     case "5":
        //                         $bulan = "november";
        //                         break;
        //                     case "6":
        //                         $bulan = "desember";
        //                         break;
        //                     default:
        //                         break;
        //                 }
        //             }
        //             elseif ($semester == "genap") {
        //                 switch ($validated["bulan"]) {
        //                     case "1":
        //                         $bulan = "januari";
        //                         break;
        //                     case "2":
        //                         $bulan = "februari";
        //                         break;
        //                     case "3":
        //                         $bulan = "maret";
        //                         break;
        //                     case "4":
        //                         $bulan = "april";
        //                         break;
        //                     case "5":
        //                         $bulan = "mei";
        //                         break;
        //                     case "6":
        //                         $bulan = "juni";
        //                         break;
        //                     default:
        //                         break;
        //                 }
        //             }
        //             DB::rollBack();
        //             throw new Exception("Transaksi sudah ada untuk siswa ".$spp->nama_lengkap." pada bulan ".$bulan." semester ".$semester." tahun ajaran ".$spp->tahun_ajaran);
        //         }
        //         $a = new Transaksi_SPP();
        //         $a->id_spp = $spp->id_spp_siswa;
        //         $a->spp = $spp->nominal;
        //         $a->potongan = $spp->nominal_potongan === null ? "0" : $spp->nominal_potongan;
        //         $a->bukti_potongan = $spp->bukti_potongan;
        //         $a->bulan=$validated["bulan"];
        //         $a->semester=$validated["semester"];
        //         $a->tahun_ajaran=$spp->tahun_ajaran;
        //         $a->nama_kelas=$spp->nama_kelas;
        //         $a->status_lunas=json_encode($encode);
        //         $a->id_ketua_komite=$ketua_komite->id_transaksi_jabatan_wali??null;
        //         $a->nama_ketua_komite=$ketua_komite->nama_wali??null;
        //         $a->id_kepala_sekolah=$kepala_sekolah->id_transaksi_jabatan_sekolah??null;
        //         $a->kepala_sekolah=$kepala_sekolah->name??null;
        //         $a->save();
        //         $c = new verifikasi_SPP();
        //         $c->id_verifikasi = $a->id_transaksi;
        //         $c->status_verifikasi = 0;
        //         $c->save();
        //     });
        //     DB::commit();
        // }
        // catch (Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route("transaksi.index")->with('errors', $e->getMessage());
        // }
        $errors=[];
        DB::transaction(function () use ($validated, $ketua_komite, $kepala_sekolah, &$errors) {
            SPP_Siswa::where("status_siswa", "1")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=","database_biodata_siswa.id" )
            ->leftJoin("nominal_spp", "spp_siswa.id_nominal", "=","nominal_spp.id_nominal" )
            ->leftJoin("potongan_spp", "potongan_spp.id_potongan", "=", "spp_siswa.id_potongan")
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
            ->select(
                "spp_siswa.*",
                "database_biodata_siswa.NO_KK",
                "database_biodata_siswa.nama_lengkap",
                "nominal_spp.nominal",
                "potongan_spp.nominal_potongan",
                "kelas.nama_kelas",
                "kelas.tahun_ajaran"
            )
            ->each(function ($spp) use ( $validated, $ketua_komite, $kepala_sekolah, &$errors) {
                $key =$spp->NO_KK.$spp->nama_lengkap;
                if (strlen($key) < 32) {
                    $key = str_pad($key, 32, 0);
                }
                if (strlen($key) > 32) {
                    $key = substr($key, 0, 32);
                }
                // ini unuk linux
                $encode = json_decode(shell_exec("./../kkp_cryptography '".$key."' '0|".date("Y-m-d")."|".Auth::user()->name."|'"), true)["cyphertext"];
                // ini untuk windows
                // $command = "C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe \"$key\" \"0|".date("Y-m-d")."|".Auth::user()->name."|\"";
                // $encode = json_decode(shell_exec($command), true)["cyphertext"];

                if($spp->id_potongan != null){
                    //linux
                    $encode_bukti_pemotongan = json_decode(shell_exec("./../kkp_cryptography '".$key."' '".$spp->bukti_potongan."'"), true)["cyphertext"];
                    //windows
                    // $command_bukti_pemotongan = "C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe \"$key\" \"".$spp->bukti_potongan."\"";
                    // $encode_bukti_pemotongan = json_decode(shell_exec($command_bukti_pemotongan), true)["cyphertext"];
                    //$encode_bukti_pemotongan = json_decode(shell_exec('C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe "'.$key."' '".$spp->bukti_potongan."'"), true)["cyphertext"];
                    $spp->bukti_potongan = json_encode($encode_bukti_pemotongan);
                }
                if(Transaksi_SPP::withTrashed()
                    ->where("id_spp", $spp->id_spp_siswa)
                    ->where("bulan", $validated["bulan"])
                    ->where("semester", $validated["semester"])
                    ->where("tahun_ajaran", $spp->tahun_ajaran)
                    ->exists()){
                    // DB::rollBack();
                    $semester = $validated["semester"] === "0" ? "ganjil" : "genap";
                    $bulan = null;
                    if ($validated["semester"] === "0") {
                        switch ($validated["bulan"]) {
                            case "1":
                                $bulan = "juli";
                                break;
                            case "2":
                                $bulan = "agustus";
                                break;
                            case "3":
                                $bulan = "september";
                                break;
                            case "4":
                                $bulan = "oktober";
                                break;
                            case "5":
                                $bulan = "november";
                                break;
                            case "6":
                                $bulan = "desember";
                                break;
                            default:
                                break;
                        }
                    } else {
                        switch ($validated["bulan"]) {
                            case "1":
                                $bulan = "januari";
                                break;
                            case "2":
                                $bulan = "februari";
                                break;
                            case "3":
                                $bulan = "maret";
                                break;
                            case "4":
                                $bulan = "april";
                                break;
                            case "5":
                                $bulan = "mei";
                                break;
                            case "6":
                                $bulan = "juni";
                                break;
                            default:
                                break;
                        }
                    }
                    $str = "Data sudah ada untuk ".$spp->nama_lengkap.
                            " pada semester ".$semester.
                            " pada bulan ".$bulan.
                            " tahun ajaran ".$spp->tahun_ajaran;
                    // return redirect()->route("transaksi.index")->with('errors', $str);
                    array_push($errors, $str);
                    return;
                }
                $transaksi = new Transaksi_SPP();
                $transaksi->id_spp = $spp->id_spp_siswa;
                $transaksi->spp = $spp->nominal;
                $transaksi->potongan = $spp->nominal_potongan === null ? "0" : $spp->nominal_potongan;
                $transaksi->bukti_potongan = $spp->bukti_potongan;
                $transaksi->bulan = $validated["bulan"];
                $transaksi->semester = $validated["semester"];
                $transaksi->tahun_ajaran = $spp->tahun_ajaran;
                $transaksi->nama_kelas = $spp->nama_kelas;
                $transaksi->status_lunas = json_encode($encode);
                $transaksi->id_ketua_komite = $ketua_komite->id_transaksi_jabatan_wali??null;
                $transaksi->nama_ketua_komite = $ketua_komite->nama_wali??null;
                $transaksi->id_kepala_sekolah = $kepala_sekolah->id_transaksi_jabatan_sekolah??null;
                $transaksi->kepala_sekolah = $kepala_sekolah->name??null;
                $transaksi->save();
                verifikasi_SPP::create([
                    "id_verifikasi" => $transaksi->id_transaksi,
                    "status_verifikasi" => 0
                ]);
            });
        });
        if (count($errors) > 0) {
            $str = implode(",", $errors);
            return redirect()->route("transaksi.index")->with('errors', $str);
        }
        return redirect()->route("transaksi.index")->with("success", "Anda membuat berhasil membuat transaksi");
    }

    /**
     * Display the specified resource.
     */
    public function show(String $transaksi_SPP)
    {
        $transaksi = Transaksi_SPP::where("id_transaksi", $transaksi_SPP)->first();
        $siswa = Siswa::leftJoin("spp_siswa", "database_biodata_siswa.id", "=", "spp_siswa.id_siswa")
        ->where("spp_siswa.id_spp_siswa", $transaksi->id_spp)
        ->select("database_biodata_siswa.NO_KK", "database_biodata_siswa.nama_lengkap")
        ->first();
        $key = $siswa->NO_KK.$siswa->nama_lengkap;
        if (strlen($key) < 32) {
            $key = str_pad($key, 32, 0);
        }
        if (strlen($key) > 32) {
            $key = substr($key, 0, 32);
        }
        //linux
        $decode_potongan = shell_exec("./../kkp_decryption '".$key."' '".$transaksi->bukti_pembayaran."'");
        //windows
        // $decode_potongan = shell_exec("C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe '".$key."' '".$transaksi->bukti_pembayaran."'");
        return FacadesStorage::download("bukti_pembayaran/".trim($decode_potongan));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($transaksi_SPP)
    {
        $transaksi_SPP = Transaksi_SPP::find($transaksi_SPP);
        if($transaksi_SPP==null){
            return redirect()->route("transaksi.index")->with("error", "Data tidak ditemukan");
        }
        // $before = $transaksi_SPP->status_lunas;
        $siswa = Siswa::find(SPP_Siswa::find($transaksi_SPP->id_spp)->id_siswa);
        $key = $siswa->NO_KK.$siswa->nama_lengkap;
        if (strlen($key) < 32) {
            $key = str_pad($key, 32, 0);
        }
        if (strlen($key) > 32) {
            $key = substr($key, 0, 32);
        }
        $user_pelunas = User::find($transaksi_SPP->created_by);
        $paraf = Paraf::where("created_by", $user_pelunas->id)->first()->image_paraf_path;
        //linux
        $decode_lunas = shell_exec("./../kkp_decryption '".$key."' '".$transaksi_SPP->status_lunas."'");
        //windows
        // $decode_lunas = shell_exec("C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe '".$key."' '".$transaksi_SPP->status_lunas."'");
        $arr = explode("|", $decode_lunas);
        // $pembuat = $user_pelunas->name;
        $pembuat = $arr[2];
        $pelunas = Auth::user()->name;

        //linux
        $encode = json_decode(shell_exec("./../kkp_cryptography '".$key."' '1|".date("Y-m-d")."|".$pembuat."|".$pelunas."'"), true)["cyphertext"];
        //windows
        // $command = "C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe \"$key\" \"1|".date("Y-m-d")."|".$pembuat."|".$pelunas."\"";
        // $encode = json_decode(shell_exec($command), true)["cyphertext"];
        //$encode = json_decode(shell_exec("C:/xampp/htdocs/SD_al_madinah-1/kkp_cryptography.exe '".$key."' '1|".date("Y-m-d")."|".$pembuat."|".$pelunas."'"), true)["cyphertext"];
        $transaksi_SPP->status_lunas = json_encode($encode);
        $data_siswa = Transaksi_SPP::leftJoin("spp_siswa",  "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
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
            ->where("transaksi_spp.id_transaksi", $transaksi_SPP->getKey())
            ->select(
                "database_biodata_siswa.nama_lengkap",
                "database_biodata_siswa.nisn",
                "NIS.id_NIS",
                "kelas.nama_kelas",
                "kelas.tahun_ajaran"
            )->first();
        $data = [
            "transaksi" => $transaksi_SPP,
            "pembuat" => $pembuat,
            "pelunas" => $pelunas,
            "siswa" => $data_siswa,
            "paraf" => $paraf
        ];
        $pdf = PDF::loadView('pdf.struk_pembayaran', $data, [], [
            'format'=> 'A4',
            'default_font_size'=> '10',
            'margin_top'=> 40,
        ])->save("../storage/app/private/struk/struk_".$transaksi_SPP->getKey().".pdf");

        $transaksi_SPP->save();
        $transaksi_SPP->delete();
        return redirect()->back()->with("success", "Anda berhasil membayar transaksi");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksi_SPPRequest $request, Transaksi_SPP $transaksi_SPP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $transaksi_SPP)
    {
        $transaksi_SPP = Transaksi_SPP::find($transaksi_SPP);
        $transaksi_SPP->forceDelete();
        return redirect()->route("transaksi.index")->with("success", "Anda berhasil menghapus transaksi");
    }
    public function cari(Request $request)
    {
        $cari = $request->cari_siswa;
        $data = Transaksi_SPP::leftJoin("spp_siswa", "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->whereNotNull("NIS.id_NIS")
            ->where("database_biodata_siswa.nama_lengkap", "LIKE", "%".$cari."%")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap",
                "database_biodata_siswa.nisn",
                "database_biodata_siswa.NO_KK",
                "NIS.id_NIS"
            )
            ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
            ->orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.semester", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->paginate(10);
        foreach ($data as $d) {
            $key =$d->NO_KK.$d->nama_lengkap;
            if (strlen($key) < 32) {
                $key = str_pad($key, 32, 0);
            }
            if (strlen($key) > 32) {
                $key = substr($key, 0, 32);
            }
            //linux
            $decode_potongan = shell_exec("./../kkp_decryption '".$key."' '".$d->bukti_potongan."'");
            //windows
            // $decode_potongan = shell_exec('kkp_decryption '.$key.' '.$d->bukti_potongan);
            $d->bukti_potongan = trim($decode_potongan);
            $d->NO_KK = null;
        }
        $data_dengan_bukti_pembayaran = Transaksi_SPP::leftJoin("spp_siswa",  "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa", "spp_siswa.id_siswa", "=", "database_biodata_siswa.id")
            ->leftJoin("NIS", "database_biodata_siswa.id", "=", "NIS.id_siswa")
            ->whereNotNull("NIS.id_NIS")
            ->where("database_biodata_siswa.nama_lengkap", "LIKE", "%".$cari."%")
            ->select(
                "transaksi_spp.*",
                "database_biodata_siswa.nama_lengkap",
                "database_biodata_siswa.nisn",
                "database_biodata_siswa.NO_KK",
                "NIS.id_NIS",
            )
            ->whereNotNull("transaksi_spp.bukti_pembayaran")
            ->orderBy("database_biodata_siswa.nama_lengkap", "asc")
            ->orderBy("transaksi_spp.tahun_ajaran", "asc")
            ->orderBy("transaksi_spp.semester", "asc")
            ->orderBy("transaksi_spp.bulan", "asc")
            ->paginate(10);
        foreach ($data_dengan_bukti_pembayaran as $x) {
            if($x->bukti_potongan != null|| trim($x->bukti_potongan) != ""||is_null($x->bukti_potongan)||trim($x->bukti_potongan) != null|| $x->bukti_pembayaran != ""||is_null($x->bukti_pembayaran))
            {
                $key =$x->NO_KK.$x->nama_lengkap;
                if (strlen($key) < 32) {
                    $key = str_pad($key, 32, 0);
                }
                if (strlen($key) > 32) {
                    $key = substr($key, 0, 32);
                }
            }
            if($x->bukti_potongan != null|| trim($x->bukti_potongan) != ""||is_null($x->bukti_potongan)){
                //linux
                $decode_potongan = shell_exec("./../kkp_decryption '".$key."' '".$x->bukti_potongan."'");
                //windows
                // $decode_potongan = shell_exec('kkp_decryption '.$key.' '.$x->bukti_potongan);
                $x->bukti_potongan = trim($decode_potongan);
            }
            if($x->bukti_pembayaran != null|| trim($x->bukti_pembayaran) != ""||is_null($x->bukti_pembayaran)){
                //linux
                $decode_pembayaran = shell_exec("./../kkp_decryption '".$key."' '".$x->bukti_pembayaran."'");
                //windows
                // $decode_pembayaran = shell_exec('kkp_decryption '.$key.' '.$x->bukti_pembayaran);
                $x->bukti_pembayaran = trim($decode_pembayaran);
            }
            $x->NO_KK = null;
        }
        return view("SPP.transaksi_spp.index")->with(["data" => $data, "cari_siswa" => $cari, "data_dengan_bukti_pembayaran" => $data_dengan_bukti_pembayaran]);
    }
}
