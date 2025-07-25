@extends('layouts.app', [
    'namePage' => 'Dashboard SPP',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
    'activeMenu' => 'SPP',
])
{{--  --}}

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <table width="100%">
              <tr>
                <td class="text-left">
                    <h5 class="card-category">Jumlah siswa per kulan yang belum dibayar</h5>
                    <h4 class="card-title"> Jumlah</h4>
                </td>
                <td class="text-right col-md-3">
                    <div class="toolbar ">
                        <table width="100%">
                            <form action="{{ route('cetak.laporan_keuangan') }}" method="GET">
                                @csrf
                                <tr->
                                    <td>
                                        <select name="tahun_ajaran" class="form-control">
                                            <option value="">Pilih tahun ajaran</option>
                                            @foreach ($tahun_ajaran as $tahun)
                                                <option value="{{$tahun->tahun_ajaran}}">{{$tahun->tahun_ajaran}}</option>
                                            @endforeach
                                        </select>
                                        <select name="jenis" class="form-control">
                                            <option value="">Pilih Laporan</option>
                                            <option value="1">Laporan Pemasukan</option>
                                            <option value="2">Laporan Siswa Belum Bayar</option>
                                        </select>
                                    </td>
                                    <td >
                                        <button type="submit" class="btn btn-primary btn-round text-white " >cetak</button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </td>
              </tr>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>NO</th>
                    <th>
                        Tahun ajar
                    </th>
                    <th>
                        Semester
                    </th>
                    <th>
                        Bulan
                    </th>
                    <th class="text-right">
                        Jumlah siswa
                    </th>
                </thead>
                <tbody>
                    @foreach ($data as $nunggak)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$nunggak->tahun_ajaran}}</td>
                        @if ($nunggak->semester==0)
                            <td>Gasal</td>
                            <td>
                                @switch( $nunggak->bulan )
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
                            </td>
                        @else
                            <td>Genap</td>
                            <td>
                                @switch( $nunggak->bulan )
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
                            </td>
                        @endif
                        <td class="text-right">
                            {{$nunggak->jumlah}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="row">
                <div class="d-flex justify-content-center">{{ $data->links() }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    chartColor = "#FFFFFF";

    // General configuration for the charts with Line gradientStroke
    gradientChartOptionsConfiguration = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: 1,
        scales: {
            yAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }],
            xAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 15,
                bottom: 15
            }
        }
    };

    gradientChartOptionsConfigurationWithNumbersAndGrid = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: true,
        scales: {
            yAxes: [{
                gridLines: 0,
                gridLines: {
                    zeroLineColor: "transparent",
                    drawBorder: false
                }
            }],
            xAxes: [{
                display: 0,
                gridLines: 0,
                ticks: {
                    display: false
                },
                gridLines: {
                    zeroLineColor: "transparent",
                    drawTicks: false,
                    display: false,
                    drawBorder: false
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 15,
                bottom: 15
            }
        }
    };

    // var ctx = document.getElementById('bigDashboardChart').getContext("2d");

    // var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    // gradientStroke.addColorStop(0, '#80b6f4');
    // gradientStroke.addColorStop(1, chartColor);

    // var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
    //         datasets: [{
    //             label: "Data",
    //             borderColor: chartColor,
    //             pointBorderColor: chartColor,
    //             pointBackgroundColor: "#1e3d60",
    //             pointHoverBackgroundColor: "#1e3d60",
    //             pointHoverBorderColor: chartColor,
    //             pointBorderWidth: 1,
    //             pointHoverRadius: 7,
    //             pointHoverBorderWidth: 2,
    //             pointRadius: 5,
    //             fill: true,
    //             backgroundColor: gradientFill,
    //             borderWidth: 2,
    //             data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95]
    //         }]
    //     },
    //     options: {
    //         layout: {
    //             padding: {
    //                 left: 20,
    //                 right: 20,
    //                 top: 0,
    //                 bottom: 0
    //             }
    //         },
    //         maintainAspectRatio: false,
    //         tooltips: {
    //             backgroundColor: '#fff',
    //             titleFontColor: '#333',
    //             bodyFontColor: '#666',
    //             bodySpacing: 4,
    //             xPadding: 12,
    //             mode: "nearest",
    //             intersect: 0,
    //             position: "nearest"
    //         },
    //         legend: {
    //             position: "bottom",
    //             fillStyle: "#FFF",
    //             display: false
    //         },
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     fontColor: "rgba(255,255,255,0.4)",
    //                     fontStyle: "bold",
    //                     beginAtZero: true,
    //                     maxTicksLimit: 5,
    //                     padding: 10
    //                 },
    //                 gridLines: {
    //                     drawTicks: true,
    //                     drawBorder: false,
    //                     display: true,
    //                     color: "rgba(255,255,255,0.1)",
    //                     zeroLineColor: "transparent"
    //                 }

    //             }],
    //             xAxes: [{
    //                 gridLines: {
    //                     zeroLineColor: "transparent",
    //                     display: false,

    //                 },
    //                 ticks: {
    //                     padding: 10,
    //                     fontColor: "rgba(255,255,255,0.4)",
    //                     fontStyle: "bold"
    //                 }
    //             }]
    //         }
    //     }
    // });

    // var cardStatsMiniLineColor = "#fff",
    //     cardStatsMiniDotColor = "#fff";
    //
    // ctx = document.getElementById('lineChartExample').getContext("2d");

    // gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    // gradientStroke.addColorStop(0, '#80b6f4');
    // gradientStroke.addColorStop(1, chartColor);

    // gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    // myChart = new Chart(ctx, {
    //     type: 'line',
    //     responsive: true,
    //     data: {
    //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //         datasets: [{
    //             label: "Active Users",
    //             borderColor: "#f96332",
    //             pointBorderColor: "#FFF",
    //             pointBackgroundColor: "#f96332",
    //             pointBorderWidth: 2,
    //             pointHoverRadius: 4,
    //             pointHoverBorderWidth: 1,
    //             pointRadius: 4,
    //             fill: true,
    //             backgroundColor: gradientFill,
    //             borderWidth: 2,
    //             data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
    //         }]
    //     },
    //     options: gradientChartOptionsConfiguration
    // });


    // ctx = document.getElementById('lineChartExampleWithNumbersAndGrid').getContext("2d");

    // gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    // gradientStroke.addColorStop(0, '#18ce0f');
    // gradientStroke.addColorStop(1, chartColor);

    // gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));

    // myChart = new Chart(ctx, {
    //     type: 'line',
    //     responsive: true,
    //     data: {
    //         labels: ["12pm,", "3pm", "6pm", "9pm", "12am", "3am", "6am", "9am"],
    //         datasets: [{
    //             label: "Email Stats",
    //             borderColor: "#18ce0f",
    //             pointBorderColor: "#FFF",
    //             pointBackgroundColor: "#18ce0f",
    //             pointBorderWidth: 2,
    //             pointHoverRadius: 4,
    //             pointHoverBorderWidth: 1,
    //             pointRadius: 4,
    //             fill: true,
    //             backgroundColor: gradientFill,
    //             borderWidth: 2,
    //             data: [40, 500, 650, 700, 1200, 1250, 1300, 1900]
    //         }]
    //     },
    //     options: gradientChartOptionsConfigurationWithNumbersAndGrid
    // });

    // var e = document.getElementById("barChartSimpleGradientsNumbers").getContext("2d");

    // gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
    // gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    // gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

    // var a = {
    //     type: "bar",
    //     data: {
    //         labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    //         datasets: [{
    //             label: "Active Countries",
    //             backgroundColor: gradientFill,
    //             borderColor: "#2CA8FF",
    //             pointBorderColor: "#FFF",
    //             pointBackgroundColor: "#2CA8FF",
    //             pointBorderWidth: 2,
    //             pointHoverRadius: 4,
    //             pointHoverBorderWidth: 1,
    //             pointRadius: 4,
    //             fill: true,
    //             borderWidth: 1,
    //             data: [80, 99, 86, 96, 123, 85, 100, 75, 88, 90, 123, 155]
    //         }]
    //     },
    //     options: {
    //         maintainAspectRatio: false,
    //         legend: {
    //             display: false
    //         },
    //         tooltips: {
    //             bodySpacing: 4,
    //             mode: "nearest",
    //             intersect: 0,
    //             position: "nearest",
    //             xPadding: 10,
    //             yPadding: 10,
    //             caretPadding: 10
    //         },
    //         responsive: 1,
    //         scales: {
    //             yAxes: [{
    //                 gridLines: 0,
    //                 gridLines: {
    //                     zeroLineColor: "transparent",
    //                     drawBorder: false
    //                 }
    //             }],
    //             xAxes: [{
    //                 display: 0,
    //                 gridLines: 0,
    //                 ticks: {
    //                     display: false
    //                 },
    //                 gridLines: {
    //                     zeroLineColor: "transparent",
    //                     drawTicks: false,
    //                     display: false,
    //                     drawBorder: false
    //                 }
    //             }]
    //         },
    //         layout: {
    //             padding: {
    //                 left: 0,
    //                 right: 0,
    //                 top: 15,
    //                 bottom: 15
    //             }
    //         }
    //     }
    // };

    // var viewsChart = new Chart(e, a);
    });
  </script>
@endpush
