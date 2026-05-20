<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = [
        'dueno_id', 'nombre', 'especie', 'raza', 'sexo', 'peso', 'motivo_consulta',
        'fecha_nacimiento', 'tipo_sangre', 'comportamiento', 'es_adoptado',
    ];

    public function dueno()
    {
        return $this->belongsTo(Dueno::class);
    }
}
