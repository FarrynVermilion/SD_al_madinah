<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Extra details for Live View on GitHub Pages -->
  <title>
    Sistem SMP Al Madinah
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  {{-- <!-- CSS Just for demo purpose, don't include it in your project --> --}}
  {{-- <link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" /> --}}
  @vite('resources/css/app.css')
  <style>
    ::backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }
  </style>
</head>

<body class="{{ $class ?? '' }}">
  <div class="wrapper">
    @if ($activePage!="login")
    @auth
        @switch(Auth::user()->role)
            @case("Admin")
                @include('layouts.page_template.admin')
                @break
            @case("Tata_Usaha")
                @include('layouts.page_template.tata_usaha')
                @break
            @case("Guru")
                @include('layouts.page_template.guru')
                @break
            @case("Siswa")
                @include('layouts.page_template.siswa')
                @break
            @default
        @endswitch
    @endauth
    @else
        @include('layouts.page_template.guest')
    @endif

  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
  <!-- Chart JS -->
  {{-- <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script> --}}
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets') }}/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  {{-- <!-- Now Ui Dashboard DEMO methods, don't include it in your project! --> --}}
  {{-- <script src="{{ asset('assets') }}/demo/demo.js"></script> --}}
  @stack('js')
</body>

</html>
