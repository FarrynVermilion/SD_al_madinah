
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>struk pembayaran {{$siswa->id_NIS}}
        {{$transaksi->tahun_ajaran}}
        @if ($transaksi->semester == 0)
            Gasal
            @switch($transaksi->bulan)
                @case(1)
                    Juli
                    @break
                @case(2)
                    Agustus
                    @break
                @case(3)
                    September
                    @break
                @case(4)
                    Oktober
                    @break
                @case(5)
                    November
                    @break
                @case(6)
                    Desember
                    @break
                @default
                    @break
            @endswitch
        @else
            Genap
            @switch($transaksi->bulan)
                @case(1)
                    Januari
                    @break
                @case(2)
                    Februari
                    @break
                @case(3)
                    Maret
                    @break
                @case(4)
                    April
                    @break
                @case(5)
                    Mei
                    @break
                @case(6)
                    Juni
                    @break
                @default
                    @break
            @endswitch
        @endif
    </title>
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

    .footer{
        width: 100%;
        text-align: right;
        margin: auto;
        padding-bottom: 0.2em;
    }
    .page_break {
        page-break-after: always;
    }

    table, th, td ,tr {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    p{
        text-align: center;
        margin: 0;
    }
    </style>
</head>

<body>
    <htmlpageheader name="page-header">
        <div class="header">
            <p>STRUK PEMBAYARAN SMP AL-MADINAH</p>
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
                <hr>
            </p>

        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer" >
        <div class="footer">
            <hr>
            <p>
                Tagihan dibuat oleh : {{$pembuat}} | Tagihan dilunaskan oleh : {{$pelunas}} | {PAGENO} dari {nbpg}
            </p>
        </div>
    </htmlpagefooter>
    <div class="content">
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $siswa->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->nama_kelas }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td>{{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $siswa->id_NIS }}
            </tr>
        </table>
        <br>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>No Tagihan</th>
                    <th>Tahun ajaran</th>
                    <th>Semester</th>
                    <th>Bulan</th>
                    <th>Jumlah SPP</th>
                    <th>Jumlah potongan</th>
                    <th>Total Tagihan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        {{ $transaksi->tahun_ajaran }}
                    </td>
                    @if ($transaksi->semester == 0)
                        <td>Gasal</td>
                        @switch($transaksi->bulan)
                            @case(1)
                                <td>Juli</td>
                                @break
                            @case(2)
                                <td>Agustus</td>
                                @break
                            @case(3)
                                <td>September</td>
                                @break
                            @case(4)
                                <td>Oktober</td>
                                @break
                            @case(5)
                                <td>November</td>
                                @break
                            @case(6)
                                <td>Desember</td>
                                @break
                            @default
                                @break
                        @endswitch
                    @else
                        <td>Genap</td>
                        @switch($transaksi->bulan)
                            @case(1)
                                <td>Januari</td>
                                @break
                            @case(2)
                                <td>Februari</td>
                                @break
                            @case(3)
                                <td>Maret</td>
                                @break
                            @case(4)
                                <td>April</td>
                                @break
                            @case(5)
                                <td>Mei</td>
                                @break
                            @case(6)
                                <td>Juni</td>
                                @break
                            @default
                                @break
                        @endswitch
                    @endif
                    <td>RP. {{ number_format($transaksi->spp,2,',','.') }}</td>
                    <td>RP. {{ number_format($transaksi->potongan,2,',','.') }}</td>
                    <td>RP. {{ number_format($transaksi->spp-$transaksi->potongan,2,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
