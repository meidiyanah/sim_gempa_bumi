<!-- Nav Item - Dashboard -->
<li class="nav-item @if(\Route::currentRouteName() === 'home') active @endif">
    <a class="nav-link" href="{{url('/home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Nav Item - Simulasi -->
<li class="nav-item @if(\Route::currentRouteName() === 'simulasi') active @endif">
    <a class="nav-link" href="{{url('/simulasi')}}">
        <i class="fa fa-fw fa-globe"></i>
        <span>Simulator</span>
    </a>
</li>

@if(Auth::user()->jenis_user == 1)
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master
</div>

<!-- Nav Item - Master Uder -->
<li class="nav-item @if(str_contains(\Route::currentRouteName(), 'data-user')) active @endif">
    <a class="nav-link" href="{{url('/data-user')}}">
        <i class="fas fa-fw fa-solid fa-users"></i>
        <span>Data Pengguna</span>
    </a>
</li>

<!-- Nav Item - Master Peta -->
<li class="nav-item @if(str_contains(\Route::currentRouteName(), 'data-peta')) active @endif">
    <a class="nav-link" href="{{url('/data-peta')}}">
        <i class="fas fa-fw fa-map-marked-alt"></i>
        <span>Data Peta</span>
    </a>
</li>

<!-- Nav Item - Master Kota -->
<li class="nav-item @if(str_contains(\Route::currentRouteName(), 'data-kota')) active @endif">
    <a class="nav-link" href="{{url('/data-kota')}}">
        <i class="fas fa-fw fa-city"></i>
        <span>Data Kota</span>
    </a>
</li>
@endif

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Profil
</div>

<!-- Nav Item - Master Peta -->
<li class="nav-item @if(str_contains(\Route::currentRouteName(), 'profile')) active @endif">
    <a class="nav-link" href="{{route('profile.index')}}">
        <i class="fa fa-fw fa-user"></i>
        <span>Ubah Profil</span>
    </a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li> -->