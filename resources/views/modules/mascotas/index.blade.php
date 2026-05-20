@extends('layouts.main')
@section('titulo_pagina', 'Pacientes')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-dog mr-2"></i>Pacientes</h1>
    <a href="{{ route('pacientes.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Nuevo Paciente
    </a>
</div>

{{-- Buscador --}}
<div class="card shadow mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('pacientes.index') }}">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar por nombre, especie, raza o dueño..."
                       value="{{ request('q') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        @if ($mascotas->isEmpty())
            <p class="text-muted text-center py-4">No se encontraron pacientes.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Dueño</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->id }}</td>
                        <td class="font-weight-bold">{{ $mascota->nombre }}</td>
                        <td class="text-capitalize">{{ $mascota->especie ?? '—' }}</td>
                        <td>{{ $mascota->raza ?? '—' }}</td>
                        <td>{{ $mascota->dueno->nombre_completo ?? '—' }}</td>
                        <td>{{ $mascota->dueno->telefono ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $mascotas->links() }}</div>
        @endif
    </div>
</div>

@endsection
