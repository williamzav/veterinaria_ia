<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionSistema;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $config = ConfiguracionSistema::first() ?? new ConfiguracionSistema();
        return view('modules.admin.configuracion.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre_clinica'    => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:50',
            'direccion_fisica'  => 'nullable|string|max:500',
            'mision'            => 'nullable|string',
            'vision'            => 'nullable|string',
            'valores'           => 'nullable|string',
            'historia'          => 'nullable|string',
        ]);

        ConfiguracionSistema::updateOrCreate(
            ['id' => 1],
            $request->only([
                'nombre_clinica', 'telefono_contacto', 'direccion_fisica',
                'mision', 'vision', 'valores', 'historia',
            ])
        );

        return redirect()->route('admin.configuracion.index')
            ->with('success', 'Configuración guardada correctamente.');
    }
}
