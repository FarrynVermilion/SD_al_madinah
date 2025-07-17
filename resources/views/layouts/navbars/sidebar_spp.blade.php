<div class="sidebar" data-color="dark-green">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
      <p class="simple-text logo-mini">
        {{ __('Welcome') }}
      </p>
      <p class="simple-text logo-normal">
        {{Auth::user()->name}}
      </p>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <li class="@if ($activePage == 'home') active @endif">
          <a href="{{ route('homeSPP') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Dashboard') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'Nominal SPP') active @endif">
          <a href="{{ route('nominal.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Nominal SPP') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'Potongan SPP') active @endif">
          <a href="{{ route('potongan.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Potongan SPP') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'SPP Siswa') active @endif">
          <a href="{{ route('SPPsiswa.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('SPP siswa') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'Tramsaksi SPP') active @endif">
          <a href="{{ route('transaksi.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Transaksi SPP') }}</p>
          </a>
        </li>

        <li class="@if ($activePage == 'Verifikasi_SPP') active @endif">
          <a href="{{ route('verifikasi.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Cerifikasi SPP') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'Paraf') active @endif">
          <a href="{{ route('paraf.index') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Paraf Tata Usaha') }}</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
