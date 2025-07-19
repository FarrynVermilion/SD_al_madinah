
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
    .center {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    /* table, th, td ,tr {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    } */
    /* p{
        text-align: center;
        margin: 0;
    } */
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <htmlpageheader name="page-header">

        <header class="header">
            <div style="width: 50px; position: absolute; top: 0; left: 0; ">
                <img src="assets/img/smp_logo.jpg">
            </div>
            <div style="text-align: center ; position: absolute; top: 0; ">
                <table>
                    <tr>
                        <td>
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
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
        </header>
    </htmlpageheader>
    <htmlpagefooter name="page-footer" >
        <div class="footer">
            <hr>
            <p style="text-align: right">
                Tagihan dibuat oleh : {{$pembuat}} | {PAGENO} dari {nbpg}
            </p>
        </div>
    </htmlpagefooter>
    <div class="content">
        <table class="table">
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
        <table class="table table-bordered table-striped border border-dark" >
            <thead class="thead-dark">
                <tr class="row border border-dark table-dark">
                    <th class="col">No Tagihan</th>
                    <th class="col">Tahun ajaran</th>
                    <th class="col">Semester</th>
                    <th class="col">Bulan</th>
                    <th class="col">Jumlah SPP</th>
                    <th class="col">Jumlah potongan</th>
                    <th class="col">Total Tagihan</th>
                </tr>
            </thead>
            <tbody >
                <tr class="row border border-dark">
                    <td class="col">
                        1
                    </td>
                    <td class="col">
                        {{ $transaksi->tahun_ajaran }}
                    </td class="col">
                    @if ($transaksi->semester == 0)
                        <td  class="col">Gasal</td>
                        @switch($transaksi->bulan)
                            @case(1)
                                <td  class="col">Juli</td>
                                @break
                            @case(2)
                                <td  class="col">Agustus</td>
                                @break
                            @case(3)
                                <td  class="col">September</td>
                                @break
                            @case(4)
                                <td  class="col">Oktober</td>
                                @break
                            @case(5)
                                <td  class="col">November</td>
                                @break
                            @case(6)
                                <td  class="col">Desember</td>
                                @break
                            @default
                                @break
                        @endswitch
                    @else
                        <td  class="col">Genap</td>
                        @switch($transaksi->bulan)
                            @case(1)
                                <td class="col">Januari</td>
                                @break
                            @case(2)
                                <td class="col">Februari</td>
                                @break
                            @case(3)
                                <td class="col">Maret</td>
                                @break
                            @case(4)
                                <td class="col">April</td>
                                @break
                            @case(5)
                                <td class="col">Mei</td>
                                @break
                            @case(6)
                                <td class="col">Juni</td>
                                @break
                            @default
                                @break
                        @endswitch
                    @endif
                    <td class="col">RP. {{ number_format($transaksi->spp,2,',','.') }}</td>
                    <td class="col">RP. {{ number_format($transaksi->potongan,2,',','.') }}</td>
                    <td class="col">RP. {{ number_format($transaksi->spp-$transaksi->potongan,2,',','.') }}</td>
                </tr>
            </tbody>
        </table>
        <div style="width: 100% ; text-align: right; justify-content: right; justify-items: right;">
            <table style="width: 20%; text-align: right; justify-content: right; justify-items: right; justify-self: right; " >
                <thead>
                    <tr>
                        <th style="text-align: center; ">Tata usaha SMP AL-MADINAH</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; ">Menyetujui</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img style="width: 200px;" src="../storage/app/private/paraf/{{ $paraf }}" >
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">{{ $pelunas }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
