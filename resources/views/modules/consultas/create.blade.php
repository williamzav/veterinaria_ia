@extends('layouts.main')
@section('titulo_pagina', 'Nueva Consulta')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-stethoscope mr-2"></i>Nueva Consulta</h1>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Volver
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Datos de la consulta</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('consultas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Paciente <span class="text-danger">*</span></label>
                        <select name="mascota_id" class="form-control @error('mascota_id') is-invalid @enderror" required>
                            <option value="">— Selecciona una mascota —</option>
                            @foreach ($mascotas as $m)
                                <option value="{{ $m->id }}" {{ old('mascota_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nombre }} ({{ $m->dueno->nombre_completo ?? 'Sin dueño' }})
                                </option>
                            @endforeach
                        </select>
                        @error('mascota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Fecha y hora <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="fecha_consulta"
                               class="form-control @error('fecha_consulta') is-invalid @enderror"
                               value="{{ old('fecha_consulta', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('fecha_consulta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold">Peso (kg)</label>
                        <input type="number" name="peso" step="0.01" min="0"
                               class="form-control @error('peso') is-invalid @enderror"
                               value="{{ old('peso') }}" placeholder="Ej. 3.5">
                        @error('peso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold">Talla (cm)</label>
                        <input type="number" name="talla" step="0.01" min="0"
                               class="form-control @error('talla') is-invalid @enderror"
                               value="{{ old('talla') }}" placeholder="Ej. 25">
                        @error('talla') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Diagnóstico</label>
                <textarea name="diagnostico" class="form-control" rows="3"
                          placeholder="Describe el diagnóstico...">{{ old('diagnostico') }}</textarea>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Tratamiento</label>
                <textarea name="tratamiento" class="form-control" rows="3"
                          placeholder="Medicamentos, indicaciones...">{{ old('tratamiento') }}</textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary mr-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Guardar Consulta
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
