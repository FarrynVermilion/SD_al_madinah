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
        <li class="@if ($activePage == 'profile') active @endif">
            <a href="{{ route('profile.edit') }}">
            <i class="now-ui-icons users_single-02"></i>
            <p> {{ __("User Profile") }} </p>
            </a>
        </li>
        <li class="@if ($activePage == 'users') active @endif">
            <a href="{{ route('user.index') }}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p> {{ __("User Management") }} </p>
            </a>
        </li>
        <li class="@if ($activePage == 'jabatan') active @endif">
            <a href="{{ route('jabatan.index') }}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p> {{ __("Jabatan Management") }} </p>
            </a>
        </li>
        {{-- <li class="@if ($activePage == 'icons') active @endif">
          <a href="{{ route('page.index','icons') }}">
            <i class="now-ui-icons education_atom"></i>
            <p>{{ __('Icons') }}</p>
          </a>
        </li>
        <li class = "@if ($activePage == 'maps') active @endif">
          <a href="{{ route('page.index','maps') }}">
            <i class="now-ui-icons location_map-big"></i>
            <p>{{ __('Maps') }}</p>
          </a>
        </li>
        <li class = " @if ($activePage == 'notifications') active @endif">
          <a href="{{ route('page.index','notifications') }}">
            <i class="now-ui-icons ui-1_bell-53"></i>
            <p>{{ __('Notifications') }}</p>
          </a>
        </li>
        <li class = " @if ($activePage == 'table') active @endif">
          <a href="{{ route('page.index','table') }}">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>{{ __('Table List') }}</p>
          </a>
        </li>
        <li class = "@if ($activePage == 'typography') active @endif">
          <a href="{{ route('page.index','typography') }}">
            <i class="now-ui-icons text_caps-small"></i>
            <p>{{ __('Typography') }}</p>
          </a>
        </li> --}}
      </ul>
    </div>
  </div>
