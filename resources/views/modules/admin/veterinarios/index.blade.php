@extends('layouts.admin')

@section('titulo_pagina', 'Veterinarios')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-user-md mr-2"></i>Veterinarios
    </h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus mr-1"></i> Nuevo Veterinario
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Personal registrado</h6>
    </div>
    <div class="card-body">
        @if ($veterinarios->isEmpty())
            <p class="text-muted text-center py-4">No hay veterinarios registrados aún.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Cédula</th>
                        <th class="text-center">Consultas</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($veterinarios as $vet)
                    <tr>
                        <td>{{ $vet->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $vet->nombre_completo }}</div>
                            @if ($vet->usuario)
                                <small class="text-muted">{{ $vet->usuario->email }}</small>
                            @endif
                        </td>
                        <td>{{ $vet->especialidad ?? '—' }}</td>
                        <td>{{ $vet->cedula_profesional ?? '—' }}</td>
                        <td class="text-center">
                            <span class="badge badge-info">{{ $vet->consultas_count }}</span>
                        </td>
                        <td class="text-center">
                            @if ($vet->usuario && $vet->usuario->activo)
                                <span class="badge badge-success">Activo</span>
                            @else
                                <span class="badge badge-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($vet->usuario)
                            <a href="{{ route('admin.users.edit', $vet->usuario->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $veterinarios->links() }}</div>
        @endif
    </div>
</div>

@endsection
