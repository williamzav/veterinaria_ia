@extends('layouts.admin')

@section('titulo_pagina', 'Reportes')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-chart-bar mr-2"></i>Reportes del Sistema
    </h1>
    <a href="{{ route('admin.reportes.exportar') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-file-pdf mr-1"></i> Exportar PDF
    </a>
</div>

{{-- Tarjetas métricas --}}
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Usuarios</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsuarios }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mascotas Registradas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMascotas }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-paw fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Consultas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalConsultas }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-stethoscope fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Veterinarios</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVeterinarios }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-user-md fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Actividad por veterinario --}}
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-md mr-1"></i> Actividad por Veterinario
                </h6>
            </div>
            <div class="card-body">
                @forelse ($actividadVets as $vet)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-gray-800 font-weight-bold">{{ $vet->nombre_completo }}</span>
                            <span class="text-muted small">{{ $vet->consultas_count }} consulta(s)</span>
                        </div>
                        @php
                            $max = $actividadVets->max('consultas_count') ?: 1;
                            $pct = round(($vet->consultas_count / $max) * 100);
                        @endphp
                        <div class="progress" style="height:8px;">
                            <div class="progress-bar bg-primary" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">No hay veterinarios registrados aún.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Mascotas por especie --}}
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fas fa-paw mr-1"></i> Mascotas por Especie
                </h6>
            </div>
            <div class="card-body">
                @forelse ($mascotasPorEspecie as $especie)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-gray-800 font-weight-bold text-capitalize">{{ $especie->especie }}</span>
                            <span class="text-muted small">{{ $especie->total }}</span>
                        </div>
                        @php
                            $maxE = $mascotasPorEspecie->max('total') ?: 1;
                            $pctE = round(($especie->total / $maxE) * 100);
                        @endphp
                        <div class="progress" style="height:8px;">
                            <div class="progress-bar bg-success" style="width: {{ $pctE }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">No hay mascotas registradas aún.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Consultas por mes --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-calendar-alt mr-1"></i> Consultas por Mes (últimos 6 meses)
        </h6>
    </div>
    <div class="card-body">
        @if ($consultasPorMes->isEmpty())
            <p class="text-muted text-center py-3">No hay consultas registradas aún.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Mes</th>
                        <th class="text-center">Total Consultas</th>
                        <th>Barra</th>
                    </tr>
                </thead>
                <tbody>
                    @php $maxM = $consultasPorMes->max('total') ?: 1; @endphp
                    @foreach ($consultasPorMes as $cm)
                    <tr>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $cm->mes)->translatedFormat('F Y') }}</td>
                        <td class="text-center font-weight-bold">{{ $cm->total }}</td>
                        <td style="width:50%">
                            <div class="progress" style="height:10px;">
                                <div class="progress-bar bg-info" style="width:{{ round(($cm->total/$maxM)*100) }}%"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
