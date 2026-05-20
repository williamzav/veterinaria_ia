<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Veterinario;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Veterinario::with('usuario')->withCount('consultas')->latest()->paginate(10);
        return view('modules.admin.veterinarios.index', compact('veterinarios'));
    }
}
