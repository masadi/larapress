<nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
  <div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
              data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ms-auto">
      <li class="nav-item dropdown dropdown-language">
      <a class="nav-link nav-link-style">
            <i class="ficon" data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i>
          </a>
      </li>
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
          data-bs-toggle="dropdown" aria-haspopup="true">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder">
              @if (Auth::check())
                {{ Auth::user()->name }}
              @else
                John Doe
              @endif
            </span>
            <span class="user-status">
              {{ Auth::user()->roles->unique()->implode('display_name', ', ') }}
            </span>
          </div>
          <span class="avatar">
            <img class="round"
              src="{{ Auth::user() ? Auth::user()->profile_photo_url : '' }}"
              alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <h6 class="dropdown-header">Manage Profile</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item"
            href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="user"></i> Profile
          </a>
          @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
            <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
              <i class="me-50" data-feather="key"></i> API Tokens
            </a>
          @endif
          <a class="dropdown-item" href="#">
            <i class="me-50" data-feather="settings"></i> Settings
          </a>

          @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Manage Team</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"
              href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="settings"></i> Team Settings
            </a>
            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
              <a class="dropdown-item" href="{{ route('teams.create') }}">
                <i class="me-50" data-feather="users"></i> Create New Team
              </a>
            @endcan

            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">
              Switch Teams
            </h6>
            <div class="dropdown-divider"></div>
            @if (Auth::user())
              @foreach (Auth::user()->allTeams() as $team)
                {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

                <x-jet-switchable-team :team="$team" />
              @endforeach
            @endif
            <div class="dropdown-divider"></div>
          @endif
          @if (Auth::check())
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="me-50" data-feather="power"></i> Logout
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
              @csrf
            </form>
          @else
            <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
              <i class="me-50" data-feather="log-in"></i> Login
            </a>
          @endif
        </div>
      </li>
    </ul>
  </div>
</nav>
<!-- END: Header-->
