{{-- SIDEBAR Veterinario PRO --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion @yield('sidebar_class')" id="accordionSidebar" style="background:linear-gradient(180deg,#4e73df 0%,#224abe 100%)!important;">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}" style="padding:1.5rem 1rem;">
        <div class="sidebar-brand-icon" style="font-size:1.8rem;">
            <i class="fas fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size:1.1rem;font-weight:800;letter-spacing:.5px;">Veterinaria</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Gestión</div>

    <li class="nav-item {{ request()->routeIs('expedientes.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('expedientes.index') }}">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Expedientes</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePacientes" aria-expanded="false" aria-controls="collapsePacientes">
            <i class="fas fa-fw fa-dog"></i>
            <span>Pacientes</span>
        </a>
        <div id="collapsePacientes" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Mascotas:</h6>
                <a class="collapse-item" href="#"><i class="fas fa-list fa-xs mr-1"></i>Ver todos</a>
                <a class="collapse-item" href="#"><i class="fas fa-plus fa-xs mr-1"></i>Nuevo paciente</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsultas" aria-expanded="false" aria-controls="collapseConsultas">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Consultas</span>
        </a>
        <div id="collapseConsultas" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Citas:</h6>
                <a class="collapse-item" href="#"><i class="fas fa-list fa-xs mr-1"></i>Ver consultas</a>
                <a class="collapse-item" href="#"><i class="fas fa-plus fa-xs mr-1"></i>Nueva cita</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Propietarios</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Sistema</div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventario</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Reportes</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
