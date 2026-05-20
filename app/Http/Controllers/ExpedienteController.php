<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function index()
    {
        return view('modules.expedientes.index');
    }

    public function buscar(Request $request)
    {
        $q = $request->input('q', '');

        $mascotas = Mascota::with('dueno')
            ->where(function ($query) use ($q) {
                $query->where('nombre', 'like', "%{$q}%")
                      ->orWhere('id', 'like', "%{$q}%")
                      ->orWhereHas('dueno', fn($d) => $d->where('nombre_completo', 'like', "%{$q}%"));
            })
            ->limit(10)
            ->get();

        return response()->json($mascotas);
    }
}
