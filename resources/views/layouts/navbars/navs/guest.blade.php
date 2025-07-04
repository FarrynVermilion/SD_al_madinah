<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-dark-green  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
    <a class="navbar-brand" href="#pablo">{{ $namePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item @if ($activePage == 'login') active @endif ">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="now-ui-icons users_circle-08"></i> {{ __("Login") }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
