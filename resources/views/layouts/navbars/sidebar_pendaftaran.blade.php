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
          <a href="{{ route('homePendaftaran') }}">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Dashboard Pendaftaran') }}</p>
          </a>
        </li>
        <li class="@if ($activePage == 'Pendaftaran Siswa') active @endif">
            <a href="{{ route('siswa.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>{{ __('Pendaftaran Siswa') }}</p>
            </a>
        </li>

        <li class="@if ($activePage == 'kelas') active @endif">
            <a href="{{ route('kelas.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>{{ __('Kelas') }}</p>
            </a>
        </li>

        <li class="@if ($activePage == 'siswa kelas') active @endif">
            <a href="{{ route('siswa_kelas.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>{{ __('Siswa Kelas') }}</p>
            </a>
        </li>

        <li class="@if ($activePage == 'NIS') active @endif">
            <a href="{{ route('NIS.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>{{ __('NIS Siswa') }}</p>
            </a>
        </li>
      </ul>
    </div>
  </div>
