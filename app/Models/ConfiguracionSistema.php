<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionSistema extends Model
{
    protected $table = 'configuracion_sistemas';

    protected $fillable = [
        'nombre_clinica', 'mision', 'vision', 'valores',
        'historia', 'precios_servicios', 'direccion_fisica',
        'telefono_contacto', 'logo_path',
    ];

    protected $casts = [
        'precios_servicios' => 'array',
    ];
}
