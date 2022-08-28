@php
$configData = Helper::{$applClasses}();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper" style="top:0px;">
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal
  {{$configData['horizontalMenuClass']}}
  {{($configData['theme'] === 'dark') ? 'navbar-dark' : 'navbar-light' }}
  navbar-shadow menu-border
  {{ ($configData['layoutWidth'] === 'boxed' && $configData['horizontalMenuType']  === 'navbar-floating') ? 'container-xxl' : '' }}"
  role="navigation"
  data-menu="menu-wrapper"
  data-menu-type="floating-nav">
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <div class="container">
        <div class="d-flex justify-content-between">
          {!! $NavbarUtama->asUl(['class' => 'nav navbar-nav', 'id' => 'main-menu-navigation', 'data-menu' => 'menu-navigation'], ['class' => 'dropdown-menu']) !!}
          <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            @if (Auth::check())
            <li class="nav-item">
              <a href="{{route('dashboard')}}" class="nav-link d-flex align-items-center"><span>Dashboard</span></a>
            </li>
            <li>
              <a title="Logout" class="nav-link d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span><i data-feather="power"></i></span>
              </a>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
            </li>  
            @else
            <li class="nav-item"><a href="{{route('login')}}" class="nav-link d-flex align-items-center"><span>Login</span></a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
      {{--<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        @if(isset($menuData[1]))
        @foreach($menuData[1]->menu as $menu)
        @php
        $custom_classes = "";
        if(isset($menu->classlist)) {
        $custom_classes = $menu->classlist;
        }
        @endphp
        <li class="nav-item @if(isset($menu->submenu)){{'dropdown'}}@endif {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : ''}}"
         @if(isset($menu->submenu)){{'data-menu=dropdown'}}@endif>
          <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="nav-link d-flex align-items-center @if(isset($menu->submenu)){{'dropdown-toggle'}}@endif" target="{{isset($menu->newTab) ? '_blank':'_self'}}"  @if(isset($menu->submenu)){{'data-bs-toggle=dropdown'}}@endif>
            <span>{{ __('locale.'.$menu->name) }}</span>
          </a>
          @if(isset($menu->submenu))
          @include('panels/horizontalSubmenu', ['menu' => $menu->submenu])
          @endif
        </li>
        @endforeach
        @endif
      </ul>
      --}}
