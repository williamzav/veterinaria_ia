@extends('layouts.main')
@section('titulo_pagina', 'Consultas')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-stethoscope mr-2"></i>Mis Consultas</h1>
    <div>
        {{-- Subir firma --}}
        <button class="btn btn-outline-secondary btn-sm mr-2" data-toggle="modal" data-target="#modalFirma">
            <i class="fas fa-signature mr-1"></i> Mi Firma / Sello
        </button>
        <a href="{{ route('consultas.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Nueva Consulta
        </a>
    </div>
</div>

{{-- Buscador --}}
<div class="card shadow mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('consultas.index') }}">
            <div class="input-group">
                <input type="text" name="q" class="form-control"
                       placeholder="Buscar por paciente o propietario..."
                       value="{{ request('q') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body p-0">
        @if ($consultas->isEmpty())
            <p class="text-muted text-center py-5">No hay consultas registradas aún.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Paciente</th>
                        <th>Propietario</th>
                        <th>Fecha</th>
                        <th>Diagnóstico</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultas as $c)
                    <tr>
                        <td class="text-muted small">{{ $c->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $c->mascota->nombre ?? '—' }}</div>
                            <small class="text-muted">{{ $c->mascota->especie ?? '' }} {{ $c->mascota->raza ? '· '.$c->mascota->raza : '' }}</small>
                        </td>
                        <td>{{ $c->mascota->dueno->nombre_completo ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->fecha_consulta)->format('d/m/Y H:i') }}</td>
                        <td>
                            <span title="{{ $c->diagnostico }}">
                                {{ \Str::limit($c->diagnostico, 40, '…') ?: '—' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('consultas.receta', $c->id) }}"
                               class="btn btn-sm btn-outline-primary" target="_blank" title="Imprimir receta PDF">
                                <i class="fas fa-file-pdf mr-1"></i> Receta
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-3 py-2">{{ $consultas->links() }}</div>
        @endif
    </div>
</div>

{{-- Modal subir firma --}}
<div class="modal fade" id="modalFirma" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-signature mr-2"></i>Mi Firma / Sello</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('perfil.firma') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @php $vet = Auth::user()->veterinario; @endphp
                    @if ($vet && $vet->foto_firma)
                        <div class="text-center mb-3">
                            <img src="{{ Storage::url($vet->foto_firma) }}" alt="Firma actual"
                                 style="max-height:80px; border:1px solid #e3e6f0; border-radius:8px; padding:4px;">
                            <p class="text-muted small mt-1">Firma actual</p>
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <label class="font-weight-bold small">Subir imagen (PNG recomendado)</label>
                        <input type="file" name="firma" class="form-control-file" accept="image/*" required>
                        <small class="text-muted">Fondo transparente o blanco. Máx. 2 MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-upload mr-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
