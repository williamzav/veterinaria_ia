{{-- TOPBAR Veterinario PRO --}}
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="border-bottom:3px solid #f0f2fa;">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    {{-- Tabs de navegación --}}
    <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item mx-1 {{ request()->routeIs('home') ? 'active' : '' }}">
            <a class="nav-link px-3 py-2" href="{{ route('home') }}"
               style="color:{{ request()->routeIs('home') ? '#4e73df' : '#858796' }};border-bottom:{{ request()->routeIs('home') ? '3px solid #4e73df' : '3px solid transparent' }};font-weight:600;border-radius:0;transition:all .2s;">
                <i class="fas fa-home mr-1"></i><span>Inicio</span>
            </a>
        </li>
        <li class="nav-item mx-1 {{ request()->routeIs('expedientes.*') ? 'active' : '' }}">
            <a class="nav-link px-3 py-2" href="{{ route('expedientes.index') }}"
               style="color:{{ request()->routeIs('expedientes.*') ? '#4e73df' : '#858796' }};border-bottom:{{ request()->routeIs('expedientes.*') ? '3px solid #4e73df' : '3px solid transparent' }};font-weight:600;border-radius:0;transition:all .2s;">
                <i class="fas fa-folder-open mr-1"></i><span>Expedientes</span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">

        {{-- Notificaciones --}}
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw text-gray-400"></i>
                <span class="badge badge-danger badge-counter">0</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-primary text-white">Notificaciones</h6>
                <div class="text-center py-3 text-muted small">Sin notificaciones nuevas</div>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- Usuario --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                <div class="mr-2 d-none d-lg-block text-right">
                    <div class="text-gray-800 small font-weight-bold">{{ Auth::user()->name ?? 'Usuario' }}</div>
                    <div class="text-gray-500" style="font-size:.7rem;">{{ ucfirst(Auth::user()->role ?? 'veterinario') }}</div>
                </div>
                <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#4e73df,#224abe);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user text-white" style="font-size:.9rem;"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="border-radius:12px;border:none;min-width:200px;">
                <div class="px-3 py-2 border-bottom">
                    <div class="font-weight-bold text-gray-800 small">{{ Auth::user()->name ?? 'Usuario' }}</div>
                    <div class="text-muted" style="font-size:.75rem;">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <a class="dropdown-item py-2" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Mi Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item py-2 text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Cerrar sesión
                </a>
            </div>
        </li>

    </ul>
</nav>
