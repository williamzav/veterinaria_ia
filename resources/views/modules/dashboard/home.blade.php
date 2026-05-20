{{-- Dashboard Veterinario PRO --}}
@extends('layouts.main')

@section('hide_sidebar', true)
@section('titulo_pagina', 'Dashboard')

@push('styles')
<style>
    .stat-card { border-radius: 16px; transition: transform 0.3s ease, box-shadow 0.3s ease; animation: fadeInUp 0.5s ease both; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important; }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
    .stat-number { font-size: 2rem; font-weight: 800; line-height: 1; }
    .welcome-banner { background: linear-gradient(135deg, #4e73df, #224abe); border-radius: 16px; padding: 1.5rem 2rem; color: white; margin-bottom: 1.5rem; animation: fadeInUp 0.4s ease; }
    .welcome-banner .time { font-size: 0.85rem; opacity: 0.8; }
    .section-card { border-radius: 16px; border: none; }
    .section-card .card-header { border-radius: 16px 16px 0 0 !important; border-bottom: 1px solid rgba(0,0,0,0.06); }
    .badge-status { border-radius: 50px; padding: 0.35em 0.8em; font-size: 0.75rem; font-weight: 600; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@section('contenido')

{{-- Banner bienvenida --}}
<div class="welcome-banner d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h4 class="mb-0 font-weight-bold">
            <i class="fas fa-hand-wave mr-2"></i>
            Hola, {{ Auth::user()->name ?? 'Veterinario' }} 👋
        </h4>
        <p class="mb-0 mt-1 time">
            <i class="fas fa-calendar-day mr-1"></i>
            {{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
        </p>
    </div>
    <div class="mt-2 mt-sm-0">
        <span class="badge badge-light text-primary px-3 py-2" style="border-radius:50px;font-size:0.85rem;">
            <i class="fas fa-user-md mr-1"></i> Veterinario
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Pacientes</div>
                        <div class="stat-number text-gray-800">{{ $totalMascotas }}</div>
                        <small class="text-muted">Mascotas registradas</small>
                    </div>
                    <div class="stat-icon bg-primary" style="opacity:0.15;position:absolute;right:1.5rem;"></div>
                    <div class="stat-icon" style="background:rgba(78,115,223,0.12);">
                        <i class="fas fa-dog text-primary"></i>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Consultas hoy</div>
                        <div class="stat-number text-gray-800">{{ $consultasHoy }}</div>
                        <small class="text-muted">Atenciones del día</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(28,200,138,0.12);">
                        <i class="fas fa-stethoscope text-success"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Propietarios</div>
                        <div class="stat-number text-gray-800">{{ $totalDuenos }}</div>
                        <small class="text-muted">Dueños registrados</small>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">Citas pendientes</div>
                        <div class="stat-number text-gray-800">0</div>
                        <small class="text-muted">Por atender</small>
                    </div>
                    <div class="stat-icon" style="background:rgba(246,194,62,0.12);">
                        <i class="fas fa-calendar-check text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Accesos rápidos --}}
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow section-card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt mr-2"></i>Accesos Rápidos
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="{{ route('expedientes.index') }}" class="btn btn-outline-primary btn-block" style="border-radius:12px;padding:1rem;">
                            <i class="fas fa-folder-open fa-lg d-block mb-1"></i>
                            <small>Expedientes</small>
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('pacientes.index') }}" class="btn btn-outline-success btn-block" style="border-radius:12px;padding:1rem;">
                            <i class="fas fa-dog fa-lg d-block mb-1"></i>
                            <small>Pacientes</small>
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('consultas.create') }}" class="btn btn-outline-info btn-block" style="border-radius:12px;padding:1rem;">
                            <i class="fas fa-stethoscope fa-lg d-block mb-1"></i>
                            <small>Nueva Consulta</small>
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('citas.create') }}" class="btn btn-outline-warning btn-block" style="border-radius:12px;padding:1rem;">
                            <i class="fas fa-calendar-plus fa-lg d-block mb-1"></i>
                            <small>Nueva Cita</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow section-card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-clock mr-2"></i>Actividad Reciente
                </h6>
            </div>
            <div class="card-body p-0">
                @forelse ($actividadReciente as $consulta)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <div class="mr-3" style="width:36px;height:36px;border-radius:50%;background:rgba(78,115,223,0.12);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-paw text-primary" style="font-size:.8rem;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="font-weight-bold text-gray-800 small">{{ $consulta->mascota->nombre ?? '—' }}</div>
                        <div class="text-muted" style="font-size:.75rem;">
                            {{ $consulta->mascota->dueno->nombre_completo ?? 'Sin dueño' }} &bull;
                            {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-clipboard-list fa-3x mb-3" style="opacity:0.2;"></i>
                    <p class="mb-0 small">No hay actividad reciente registrada.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
