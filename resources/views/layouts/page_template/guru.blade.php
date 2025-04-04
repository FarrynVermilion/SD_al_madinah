
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
{{--  --}}
@if ($activeMenu=="Home")
    @include('layouts.navbars.sidebar')
@elseif ($activeMenu=="Pelanggaran")
    @include('layouts.navbars.sidebar_pelanggaran')
@elseif ($activeMenu=="Absensi")
    @include('layouts.navbars.sidebar_absensi')
@elseif ($activeMenu=="User")
    @include('layouts.navbars.sidebar_user')
@endif
<div class="main-panel">
    @include('layouts.navbars.navs.guru')
    @yield('content')
    @include('layouts.footer')
</div>
