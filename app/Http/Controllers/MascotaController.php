<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Dueno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MascotaController extends Controller
{
    public function create()
    {
        return view('modules.mascotas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:100',
            'especie'        => 'nullable|string|max:100',
            'raza'           => 'nullable|string|max:100',
            'sexo'           => 'nullable|in:Macho,Hembra',
            'edad'           => 'nullable|integer|min:0|max:50',
            'peso'           => 'nullable|numeric|min:0',
            'motivo_consulta'=> 'nullable|string|max:255',
            'propietario'    => 'required|string|max:255',
            'celular'        => 'nullable|string|max:20',
        ]);

        $dueno = Dueno::create([
            'nombre_completo' => $request->propietario,
            'telefono'        => $request->celular,
        ]);

        $fechaNac = $request->filled('edad')
            ? now()->subYears((int) $request->edad)->format('Y-m-d')
            : null;

        Mascota::create([
            'dueno_id'        => $dueno->id,
            'nombre'          => $request->nombre,
            'especie'         => $request->especie,
            'raza'            => $request->raza,
            'sexo'            => $request->sexo,
            'peso'            => $request->peso,
            'motivo_consulta' => $request->motivo_consulta,
            'fecha_nacimiento'=> $fechaNac,
        ]);

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    public function index(Request $request)
    {
        $query = Mascota::with('dueno');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sq) use ($q) {
                $sq->where('nombre', 'like', "%$q%")
                   ->orWhere('especie', 'like', "%$q%")
                   ->orWhere('raza', 'like', "%$q%")
                   ->orWhereHas('dueno', fn($d) => $d->where('nombre_completo', 'like', "%$q%"));
            });
        }

        $mascotas = $query->latest()->paginate(12)->withQueryString();
        return view('modules.mascotas.index', compact('mascotas'));
    }
}
