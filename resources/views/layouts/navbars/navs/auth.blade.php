<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-sky-950 navbar-absolute">
    <div class="container-fluid">
      <div class="navbar-wrapper">
          <div class="flex justify-normal">
              {{-- to-do ubah sesuai navbar mau kemana --}}
              <div>
                  <a href="{{ route('home') }}" class="@if ($activeMenu == 'Home') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'Home') text-black @else  text-white @endif">{{ __('Home') }}</p>
                  </a>
              </div>
              <div>
                  <a href="{{ route('home') }}" class="@if ($activeMenu == 'SPP') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'SPP') text-black @else  text-white @endif">{{ __('SPP') }}</p>
                  </a>
              </div>
              <div>
                  <a href="{{ route('home') }}" class="@if ($activeMenu == 'Pendaftaran') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'Pendaftaran') text-black @else  text-white @endif">{{ __('Pendaftaran') }}</p>
                  </a>
              </div>
              <div>
                  <a href="{{ route('home') }}" class="@if ($activeMenu == 'Pelanggaran') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'Pelanggaran') text-black @else  text-white @endif">{{ __('Pelanggaran') }}</p>
                  </a>
              </div>
              <div>
                  <a href="{{ route('home') }}" class="@if ($activeMenu == 'Absensi') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'Absensi') text-black @else  text-white @endif">{{ __('Absensi') }}</p>
                  </a>
              </div>
              <div>
                  <a href="{{ route('user.index') }}" class="@if ($activeMenu == 'User') bg-white @else  bg-orange-500 @endif flex justify-center rounded-full py-2 px-10 mx-2">
                      <p class="@if ($activeMenu == 'User') text-black @else  text-white @endif">{{ __('User') }}</p>
                  </a>
              </div>
              <div class="flex justify-center rounded-full py-2 px-10 mx-2 background-color: transparent;">
                  <a>{{ $namePage }}</a>
              </div>
          </div>
      </div>
      <div class="navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="now-ui-icons users_single-02"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("My profile") }}</a>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("Edit profile") }}</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- End Navbar -->
