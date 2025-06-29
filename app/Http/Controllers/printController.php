<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

use App\Models\Transaksi_SPP;

class printController extends Controller
{
    public function laporan_keuangan(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
        ]);
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

        $data = [
            'tahun_ajaran'=>$request->tahun_ajaran,
            'transaksi'=>$transaksi,
            'total_spp'=>$total_SPP,
            'total_potongan'=>$total_potongan
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
}
