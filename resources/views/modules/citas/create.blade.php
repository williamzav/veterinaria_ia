@extends('layouts.main')
@section('titulo_pagina', 'Nueva Cita')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-calendar-plus mr-2"></i>Nueva Cita</h1>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-calendar-check mr-2"></i>Datos de la Cita</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Paciente <span class="text-danger">*</span></label>
                        <select name="mascota_id" class="form-control @error('mascota_id') is-invalid @enderror" required>
                            <option value="">— Selecciona una mascota —</option>
                            @foreach ($mascotas as $m)
                                <option value="{{ $m->id }}" {{ old('mascota_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                    @if ($m->especie) ({{ $m->especie }}) @endif
                                    — {{ $m->dueno->nombre_completo ?? 'Sin dueño' }}
                                </option>
                            @endforeach
                        </select>
                        @error('mascota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Veterinario</label>
                        <select name="veterinario_id" class="form-control @error('veterinario_id') is-invalid @enderror">
                            <option value="">— Sin asignar —</option>
                            @foreach ($veterinarios as $vet)
                                <option value="{{ $vet->id }}" {{ old('veterinario_id') == $vet->id ? 'selected' : '' }}>
                                    {{ $vet->nombre_completo }}
                                    @if ($vet->especialidad) — {{ $vet->especialidad }} @endif
                                </option>
                            @endforeach
                        </select>
                        @error('veterinario_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Fecha y hora <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="fecha_cita"
                               class="form-control @error('fecha_cita') is-invalid @enderror"
                               value="{{ old('fecha_cita') }}" required>
                        @error('fecha_cita') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Motivo <span class="text-danger">*</span></label>
                        <input type="text" name="motivo"
                               class="form-control @error('motivo') is-invalid @enderror"
                               value="{{ old('motivo') }}"
                               placeholder="Ej. Revisión general, vacuna, cirugía..." required>
                        @error('motivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Notas adicionales</label>
                <textarea name="notas" class="form-control" rows="3"
                          placeholder="Observaciones, instrucciones previas...">{{ old('notas') }}</textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn btn-warning text-white px-4">
                    <i class="fas fa-calendar-check mr-1"></i> Agendar Cita
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
