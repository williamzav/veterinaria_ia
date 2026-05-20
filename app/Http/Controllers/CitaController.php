<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function create()
    {
        $mascotas     = Mascota::with('dueno')->orderBy('nombre')->get();
        $veterinarios = Veterinario::orderBy('nombre_completo')->get();
        return view('modules.citas.create', compact('mascotas', 'veterinarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id'    => 'required|exists:mascotas,id',
            'veterinario_id'=> 'nullable|exists:veterinarios,id',
            'fecha_cita'    => 'required|date|after:now',
            'motivo'        => 'required|string|max:255',
            'notas'         => 'nullable|string',
        ]);

        Cita::create($request->only([
            'mascota_id', 'veterinario_id', 'fecha_cita', 'motivo', 'notas',
        ]));

        return redirect()->route('home')
            ->with('success', 'Cita agendada correctamente.');
    }
}
