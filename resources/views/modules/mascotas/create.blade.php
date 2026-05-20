@extends('layouts.main')
@section('titulo_pagina', 'Nuevo Paciente')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-dog mr-2"></i>Nuevo Paciente</h1>
    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left mr-1"></i> Volver
    </a>
</div>

<form action="{{ route('pacientes.store') }}" method="POST">
@csrf

{{-- Datos de la mascota --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-paw mr-2"></i>Datos del Paciente</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') }}" placeholder="Ej. Luna" autofocus required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Especie</label>
                    <select name="especie" class="form-control @error('especie') is-invalid @enderror">
                        <option value="">— Selecciona —</option>
                        @foreach (['Canina','Felina','Aviar','Roedor','Reptil','Otro'] as $esp)
                            <option value="{{ $esp }}" {{ old('especie') == $esp ? 'selected' : '' }}>{{ $esp }}</option>
                        @endforeach
                    </select>
                    @error('especie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Raza</label>
                    <input type="text" name="raza" class="form-control @error('raza') is-invalid @enderror"
                           value="{{ old('raza') }}" placeholder="Ej. Siamés">
                    @error('raza') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="font-weight-bold">Sexo</label>
                    <div class="d-flex mt-1" style="gap:1rem;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" value="Macho"
                                   id="macho" {{ old('sexo') == 'Macho' ? 'checked' : '' }}>
                            <label class="form-check-label" for="macho">
                                <i class="fas fa-mars text-info mr-1"></i> Macho
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexo" value="Hembra"
                                   id="hembra" {{ old('sexo') == 'Hembra' ? 'checked' : '' }}>
                            <label class="form-check-label" for="hembra">
                                <i class="fas fa-venus text-danger mr-1"></i> Hembra
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="font-weight-bold">Edad (años)</label>
                    <input type="number" name="edad" min="0" max="50"
                           class="form-control @error('edad') is-invalid @enderror"
                           value="{{ old('edad') }}" placeholder="Ej. 3">
                    @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="font-weight-bold">Peso (kg)</label>
                    <input type="number" name="peso" step="0.1" min="0"
                           class="form-control @error('peso') is-invalid @enderror"
                           value="{{ old('peso') }}" placeholder="Ej. 4.2">
                    @error('peso') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="font-weight-bold">Motivo de consulta</label>
                    <input type="text" name="motivo_consulta"
                           class="form-control @error('motivo_consulta') is-invalid @enderror"
                           value="{{ old('motivo_consulta') }}" placeholder="Ej. Vómito y falta de apetito">
                    @error('motivo_consulta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Datos del propietario --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-user mr-2"></i>Datos del Propietario</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">Nombre completo <span class="text-danger">*</span></label>
                    <input type="text" name="propietario"
                           class="form-control @error('propietario') is-invalid @enderror"
                           value="{{ old('propietario') }}" placeholder="Ej. Ana Martínez" required>
                    @error('propietario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Celular</label>
                    <input type="text" name="celular"
                           class="form-control @error('celular') is-invalid @enderror"
                           value="{{ old('celular') }}" placeholder="Ej. 5558476084">
                    @error('celular') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary mr-2">Cancelar</a>
    <button type="submit" class="btn btn-primary px-4">
        <i class="fas fa-save mr-1"></i> Registrar Paciente
    </button>
</div>

</form>
@endsection
