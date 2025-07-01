<div class="wrapper wrapper-full-page" style="background-image: url('{{ $image }}">
    @include('layouts.navbars.navs.guest')
    <div class="full-page register-page section-image" filter-color="black">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
