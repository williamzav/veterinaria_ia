{{-- Dashboard Admin PRO --}}
@extends('layouts.admin')

@section('titulo_pagina', 'Panel Administrador')

@push('styles')
<style>
    .stat-card { border-radius: 16px; transition: transform 0.3s ease, box-shadow 0.3s ease; animation: fadeInUp 0.5s ease both; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important; }
    .stat-card:nth-child(1){animation-delay:.1s}.stat-card:nth-child(2){animation-delay:.2s}.stat-card:nth-child(3){animation-delay:.3s}.stat-card:nth-child(4){animation-delay:.4s}
    .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
    .stat-number { font-size: 2rem; font-weight: 800; line-height: 1; }
    .welcome-banner { background: linear-gradient(135deg, #1cc88a, #13855c); border-radius: 16px; padding: 1.5rem 2rem; color: white; margin-bottom: 1.5rem; animation: fadeInUp 0.4s ease; }
    .section-card { border-radius: 16px; border: none; }
    .section-card .card-header { border-radius: 16px 16px 0 0 !important; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@section('contenido')

{{-- Banner bienvenida admin --}}
<div class="welcome-banner d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h4 class="mb-0 font-weight-bold">
            <i class="fas fa-shield-alt mr-2"></i>
            Panel de Administración
        </h4>
        <p class="mb-0 mt-1" style="font-size:.85rem;opacity:.8;">
            Bienvenido, <strong>{{ Auth::user()->name ?? 'Administrador' }}</strong> —
            {{ now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
        </p>
    </div>
    <div class="mt-2 mt-sm-0">
        <span class="badge badge-light text-success px-3 py-2" style="border-radius:50px;font-size:.85rem;">
            <i class="fas fa-shield-alt mr-1"></i> Administrador
        </span>
    </div>
</div>

{{-- Cards de estadísticas --}}
<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow stat-card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Total Usuarios</div>
                        <div class="stat-number text-gray-800">—</div>
                        <small class="text-muted">En el sistema</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(54,185,204,0.12);">
                        <i class="fas fa-users text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow stat-card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">Veterinarios</div>
                        <div class="stat-number text-gray-800">—</div>
                        <small class="text-muted">Activos</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(246,194,62,0.12);">
                        <i class="fas fa-user-md text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow stat-card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Consultas totales</div>
                        <div class="stat-number text-gray-800">—</div>
                        <small class="text-muted">Registradas</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(54,185,204,0.12);">
                        <i class="fas fa-stethoscope text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow stat-card h-100 py-2">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Reportes</div>
                        <div class="stat-number text-gray-800">—</div>
                        <small class="text-muted">Generados</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(28,200,138,0.12);">
                        <i class="fas fa-chart-line text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Secciones de gestión --}}
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow section-card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-users-cog mr-2"></i>Gestión de Usuarios
                </h6>
            </div>
            <div class="card-body">
                <p class="text-gray-600 mb-3 small">Administra los usuarios del sistema, asigna roles y gestiona permisos de acceso.</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-sm mr-2" style="border-radius:50px;">
                    <i class="fas fa-users mr-1"></i> Ver Usuarios
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-outline-info btn-sm" style="border-radius:50px;">
                    <i class="fas fa-user-plus mr-1"></i> Nuevo Usuario
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow section-card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="fas fa-chart-line mr-2"></i>Reportes del Sistema
                </h6>
            </div>
            <div class="card-body">
                <p class="text-gray-600 mb-3 small">Consulta estadísticas globales, actividad de veterinarios y métricas del sistema.</p>
                <a href="{{ route('admin.reportes.index') }}" class="btn btn-info btn-sm mr-2" style="border-radius:50px;">
                    <i class="fas fa-chart-bar mr-1"></i> Ver Reportes
                </a>
                <a href="{{ route('admin.reportes.exportar') }}" class="btn btn-outline-info btn-sm" style="border-radius:50px;">
                    <i class="fas fa-download mr-1"></i> Exportar PDF
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
