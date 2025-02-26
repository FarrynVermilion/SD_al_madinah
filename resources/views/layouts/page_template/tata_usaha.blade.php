
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@if ($activeMenu=="Home")
    @include('layouts.navbars.sidebar')
@elseif ($activeMenu=="SPP")
    @include('layouts.navbars.sidebar_spp')
@elseif ($activeMenu=="Pendaftaran")
    @include('layouts.navbars.sidebar_pendaftaran')
@elseif ($activeMenu=="User")
    @include('layouts.navbars.sidebar_user')
@endif

<div class="main-panel">
    @include('layouts.navbars.navs.tata_usaha')
    @yield('content')
    @include('layouts.footer')
</div>
