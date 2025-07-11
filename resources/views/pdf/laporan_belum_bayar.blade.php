
<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
    @page {
        header: page-header;
        footer: page-footer;
    }

    .header {
        width: 100%;
        text-align: center;
        margin: auto;
        padding-top: 0.2em;
        padding-bottom: 0em;
    }
    p {
        margin: 0;
    }
    .footer{
        width: 100%;
        text-align: right;
        margin: auto;
        padding-bottom: 0.2em;
    }
    table, th, td ,tr {
        margin-left: auto;
        margin-right: auto;
        border: 1px solid !important;
        text-align: center;
    }
    .detail{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    .page_break {
        page-break-after: always;
    }
    </style>
</head>

<body>
    <htmlpageheader name="page-header">
        <div class="header">
            <p>DATA SISWA BELUM BAYAR SMP AL-MADINAH</p>
            <p>
                Dokumen dibuat pertanggal
                @switch(date('w'))
                    @case(0)
                        Minggu
                        @break
                    @case(1)
                        Senin
                        @break
                    @case(2)
                        Selasa
                        @break
                    @case(3)
                        Rabu
                        @break
                    @case(4)
                        Kamis
                        @break
                    @case(5)
                        Jumat
                        @break
                    @case(6)
                        Sabtu
                        @break
                    @default
                @endswitch
                {{date('d-m-Y')}}
            <br>
            Tahun ajaran:{{ $tahun_ajaran }}
            <br>
            <hr>
            </p>

        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer" >
        <div class="footer">
            <hr>
            <p>
                Dibuat oleh | ID : {{Auth::user()->id}} | nama : {{Auth::user()->name}} | {PAGENO} dari {nbpg}
            </p>
        </div>
    </htmlpagefooter>
    <div class="content">
        <table class="table table-bordered table-striped table-hover table-sm" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun ajaran</th>
                    <th>Semester</th>
                    <th>Bulan</th>
                    <th>Jumlah siswa</th>
                    <th>Total SPP</th>
                    <th>Total potongan</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($transaksi as $tr)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $tr->tahun_ajaran }}
                    </td>
                    <td>
                        {{ $tr->semester==0?"Ganjil": "Genap" }}
                    </td>
                    <td>
                        {{ $tr->bulan }}
                    </td>
                    <td>
                        {{ $tr->jumlah }}
                    </td>
                    <td>RP. {{ number_format($tr->total_spp,2,',','.') }}</td>
                    <td>RP. {{ number_format($tr->total_potongan,2,',','.') }}</td>
                    <td>RP. {{ number_format($tr->total_spp-$tr->total_potongan,2,',','.') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <br>
            <br>
            <table>
                <tr>
                    <td>Total Belum Bayar Tahun Ajaran {{ $tahun_ajaran }} : RP. {{ number_format($total_spp-$total_potongan,2,',','.') }}</td>
                </tr>
            </table>
        </div>
        <div class="page_break"></div>
        <div class="content">
            <div class="detail">
                <h>Detail Siswa Belum Bayar</h>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun ajaran</th>
                        <th>Semester</th>
                        <th>Bulan</th>
                        <th>Nama siswa</th>
                        <th>SPP</th>
                        <th>Potongan</th>
                        <th>Total Belum Bayar</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($breakdown as $br)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $br->tahun_ajaran }}
                        </td>
                        <td>
                            {{ $br->semester==0?"Ganjil": "Genap" }}
                        </td>
                        <td>
                            {{ $br->bulan }}
                        </td>
                        <td>
                            {{ $br->nama_lengkap }}
                        </td>
                        <td>RP. {{ number_format($br->spp,2,',','.') }}</td>
                        <td>RP. {{ number_format($br->potongan,2,',','.') }}</td>
                        <td>RP. {{ number_format($br->spp-$br->potongan,2,',','.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
