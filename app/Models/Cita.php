<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'mascota_id', 'veterinario_id', 'fecha_cita', 'motivo', 'estado', 'notas',
    ];

    protected $casts = [
        'fecha_cita' => 'datetime',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class);
    }
}
