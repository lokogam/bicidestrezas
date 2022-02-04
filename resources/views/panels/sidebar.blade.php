@php
$configData = Helper::applClasses();
$role = DB::table('role_user')
    ->select('role_id')
    ->where('user_id', '=', Auth::id())
    ->get();

$role_id = $role[0]->role_id;

if ($role_id) {
    $permisos = DB::table('role_user')
        ->join('permiso_role', 'permiso_role.role_id', '=', 'role_user.role_id')
        ->join('permisos', 'permisos.id', '=', 'permiso_role.permiso_id')
        ->select('permisos.*')
        ->where('user_id', Auth::id())
        ->where('permisos.estado', 1)
        ->orderBy('id', 'ASC')
        ->get();
}
@endphp
<div class="main-menu menu-fixed {{ $configData['theme'] === 'light' ? 'menu-light' : 'menu-dark' }} menu-accordion menu-shadow"
    data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
                    <div class="">
                        {{-- <img src="{{ URL::to('images/logo.jpg') }}" height="45px" width="110px" /> --}}<strong>Bicidestrezas</strong>
                        </div>
                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary collapse-toggle-icon"
                        data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            @foreach ($permisos as $permiso)
                <li class="nav-item  {{ request()->is($permiso->url) ? 'active' : '' }} {{ request()->is($permiso->url . '/consultar') ? 'active' : '' }} {{ request()->is($permiso->url . '/guardarformulario') ? 'active' : '' }} {{ request()->is($permiso->url . '/asignarpuntousuario') ? 'active' : '' }} {{ request()->is($permiso->url . '/controles') ? 'active' : '' }}">
                    <a href="{{ URL::to($permiso->url) }}">
                        <i class="{{ $permiso->icon }}"></i> {{ $permiso->menu }}
                    </a>
                </li>
            @endforeach
            {{-- Foreach menu item ends --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
