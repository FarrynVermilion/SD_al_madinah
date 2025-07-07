@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
    'activeMenu' => 'Home',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
  <div class="content">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-icon">
            <div class="card-icon">
              <i class="material-icons">Selamat Masuk Siswa</i>
            </div>
            <p class="card-category">{{Auth::user()->name}}</p>
            <h3 class="card-title ">

            </h3>
          </div>
        </div>
      </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
    //   demo.initDashboardPageCharts();

    });
  </script>
@endpush
