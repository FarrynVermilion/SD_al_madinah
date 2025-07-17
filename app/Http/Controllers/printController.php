<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Transaksi_SPP;

class printController extends Controller
{
    public function laporan_keuangan(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'jenis' => 'required',
        ]);
        if($request->jenis == "1"){
            $transaksi = Transaksi_SPP::withTrashed()
            ->where("tahun_ajaran", $request->tahun_ajaran)
            ->whereNotNull("deleted_at")
            ->groupBy("tahun_ajaran","semester","bulan")
            ->select(
                "tahun_ajaran",
                "semester",
                "bulan",
                DB::raw('count(*) as jumlah'),
                DB::raw('sum(transaksi_spp.spp) as total_spp'),
                DB::raw('sum(transaksi_spp.potongan) as total_potongan')
            )->get();
            $total_SPP = Transaksi_SPP::withTrashed()
            ->where("tahun_ajaran", $request->tahun_ajaran)
            ->whereNotNull("deleted_at")
            ->sum("spp");

            $total_potongan = Transaksi_SPP::withTrashed()
            ->where("tahun_ajaran", $request->tahun_ajaran)
            ->whereNotNull("deleted_at")
            ->sum("potongan");

            $breakdown = Transaksi_SPP::withTrashed()
            ->where("tahun_ajaran", $request->tahun_ajaran)
            // ->whereNotNull("deleted_at")
            ->leftJoin("spp_siswa", "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa as siswa", "spp_siswa.id_siswa", "=", "siswa.id")
            ->select(
                "tahun_ajaran",
                "semester",
                "bulan",
                "siswa.id as siswa_id",
                'siswa.nama_lengkap',
                'transaksi_spp.spp',
                'transaksi_spp.potongan'
            )
            ->orderBy("tahun_ajaran","asc")
            ->orderBy("semester","asc")
            ->orderBy("bulan","asc")
            ->orderBy("siswa_id","asc")
            ->get();

            $data = [
                'tahun_ajaran'=>$request->tahun_ajaran,
                'transaksi'=>$transaksi,
                'total_spp'=>$total_SPP,
                'total_potongan'=>$total_potongan,
                'breakdown'=>$breakdown
            ];
                    // return $data;
            // Assign your data here, e.g., $data = Model::all();
            $pdf = PDF::loadView('pdf.laporan_keuangan', $data, [], [
                'format'=> 'A4-L',
                'default_font_size'=> '12',
                'margin_top'=> 25,
            ]);

            return $pdf->stream('laporan_keuangan'.$request->tahun_ajaran.'.pdf');
        }
        if($request->jenis == "2"){
            $transaksi = Transaksi_SPP::where("tahun_ajaran", $request->tahun_ajaran)
            ->groupBy("tahun_ajaran","semester","bulan")
            ->select(
                "tahun_ajaran",
                "semester",
                "bulan",
                DB::raw('count(*) as jumlah'),
                DB::raw('sum(transaksi_spp.spp) as total_spp'),
                DB::raw('sum(transaksi_spp.potongan) as total_potongan')
            )->get();
            $breakdown = Transaksi_SPP::where("tahun_ajaran", $request->tahun_ajaran)
            ->leftJoin("spp_siswa", "transaksi_spp.id_spp", "=", "spp_siswa.id_spp_siswa")
            ->leftJoin("database_biodata_siswa as siswa", "spp_siswa.id_siswa", "=", "siswa.id")
            ->select(
                "tahun_ajaran",
                "semester",
                "bulan",
                "siswa.id as siswa_id",
                'siswa.nama_lengkap',
                'transaksi_spp.spp',
                'transaksi_spp.potongan'
            )
            ->orderBy("tahun_ajaran","asc")
            ->orderBy("semester","asc")
            ->orderBy("bulan","asc")
            ->orderBy("siswa_id","asc")
            ->get();
            $total_SPP = Transaksi_SPP::where("tahun_ajaran", $request->tahun_ajaran)
            ->sum("spp");

            $total_potongan = Transaksi_SPP::where("tahun_ajaran", $request->tahun_ajaran)
            ->sum("potongan");

            $data = [
                'tahun_ajaran'=>$request->tahun_ajaran,
                'transaksi'=>$transaksi,
                'total_spp'=>$total_SPP,
                'total_potongan'=>$total_potongan,
                'breakdown'=>$breakdown
            ];
            $pdf = PDF::loadView('pdf.laporan_belum_bayar', $data, [], [
                'format'=> 'A4-L',
                'default_font_size'=> '12',
                'margin_top'=> 25,
            ]);
            return $pdf->stream('laporan_belum_bayar'.$request->tahun_ajaran.'.pdf');
        }


    }
    public function download($file){
        return Storage::download("bukti_potongan/".$file);
    }
}
