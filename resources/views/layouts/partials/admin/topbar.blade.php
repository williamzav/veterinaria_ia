{{-- TOPBAR Admin PRO --}}
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="border-bottom:3px solid #f0fff8;">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <span class="d-none d-sm-inline-flex align-items-center">
        <span class="badge badge-info px-3 py-2" style="border-radius:50px;font-size:.8rem;">
            <i class="fas fa-shield-alt mr-1"></i> Panel Administrador
        </span>
    </span>

    <ul class="navbar-nav ml-auto align-items-center">

        {{-- Notificaciones --}}
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="adminAlertsDropdown" role="button" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw text-gray-400"></i>
                <span class="badge badge-danger badge-counter">0</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="adminAlertsDropdown">
                <h6 class="dropdown-header bg-info text-white">Notificaciones</h6>
                <div class="text-center py-3 text-muted small">Sin notificaciones nuevas</div>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        {{-- Usuario Admin --}}
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="adminUserDropdown" role="button" data-toggle="dropdown">
                <div class="mr-2 d-none d-lg-block text-right">
                    <div class="text-gray-800 small font-weight-bold">{{ Auth::user()->name ?? 'Administrador' }}</div>
                    <div class="text-info" style="font-size:.7rem;font-weight:600;">Administrador</div>
                </div>
                <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#1cc88a,#13855c);display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-user-shield text-white" style="font-size:.9rem;"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="adminUserDropdown" style="border-radius:12px;border:none;min-width:200px;">
                <div class="px-3 py-2 border-bottom">
                    <div class="font-weight-bold text-gray-800 small">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="text-muted" style="font-size:.75rem;">{{ Auth::user()->email ?? '' }}</div>
                </div>
                <a class="dropdown-item py-2" href="#">
                    <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>Mi Perfil
                </a>
                <a class="dropdown-item py-2" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item py-2 text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Cerrar sesión
                </a>
            </div>
        </li>

    </ul>
</nav>
