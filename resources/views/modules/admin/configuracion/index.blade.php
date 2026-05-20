@extends('layouts.admin')

@section('titulo_pagina', 'Configuración')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-cogs mr-2"></i>Configuración del Sistema
    </h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Información de la Clínica</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.configuracion.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Nombre de la Clínica</label>
                        <input type="text" name="nombre_clinica" class="form-control"
                               value="{{ old('nombre_clinica', $config->nombre_clinica) }}"
                               placeholder="Ej. Clínica Veterinaria San Roque">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold">Teléfono</label>
                        <input type="text" name="telefono_contacto" class="form-control"
                               value="{{ old('telefono_contacto', $config->telefono_contacto) }}"
                               placeholder="Ej. 55 1234 5678">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-weight-bold">Dirección</label>
                        <input type="text" name="direccion_fisica" class="form-control"
                               value="{{ old('direccion_fisica', $config->direccion_fisica) }}"
                               placeholder="Calle, Colonia, Ciudad">
                    </div>
                </div>
            </div>

            <hr>
            <h6 class="font-weight-bold text-primary mb-3">Identidad Institucional</h6>

            <div class="form-group">
                <label class="font-weight-bold">Misión</label>
                <textarea name="mision" class="form-control" rows="3"
                          placeholder="Misión de la clínica...">{{ old('mision', $config->mision) }}</textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Visión</label>
                <textarea name="vision" class="form-control" rows="3"
                          placeholder="Visión de la clínica...">{{ old('vision', $config->vision) }}</textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Valores</label>
                <textarea name="valores" class="form-control" rows="3"
                          placeholder="Valores institucionales...">{{ old('valores', $config->valores) }}</textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Historia</label>
                <textarea name="historia" class="form-control" rows="4"
                          placeholder="Historia de la clínica...">{{ old('historia', $config->historia) }}</textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Guardar Configuración
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
