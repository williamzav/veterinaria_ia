<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mascota;
use App\Models\Veterinario;
use App\Models\ConfiguracionSistema;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConsultaController extends Controller
{
    public function index(Request $request)
    {
        $vet   = Auth::user()->veterinario;
        $query = Consulta::with('mascota.dueno')
            ->when($vet, fn($q) => $q->where('veterinario_id', $vet->id))
            ->latest('fecha_consulta');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('mascota', fn($m) => $m->where('nombre', 'like', "%$q%")
                ->orWhereHas('dueno', fn($d) => $d->where('nombre_completo', 'like', "%$q%")));
        }

        $consultas = $query->paginate(10)->withQueryString();
        return view('modules.consultas.index', compact('consultas'));
    }

    public function create()
    {
        $mascotas = Mascota::with('dueno')->orderBy('nombre')->get();
        return view('modules.consultas.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id'     => 'required|exists:mascotas,id',
            'fecha_consulta' => 'required|date',
            'peso'           => 'nullable|numeric|min:0',
            'talla'          => 'nullable|numeric|min:0',
            'diagnostico'    => 'nullable|string',
            'tratamiento'    => 'nullable|string',
        ]);

        $vet = Auth::user()->veterinario;
        if (!$vet) {
            return back()->with('error', 'Tu cuenta no tiene perfil de veterinario asignado.');
        }

        Consulta::create([
            'mascota_id'     => $request->mascota_id,
            'veterinario_id' => $vet->id,
            'fecha_consulta' => $request->fecha_consulta,
            'peso'           => $request->peso,
            'talla'          => $request->talla,
            'diagnostico'    => $request->diagnostico,
            'tratamiento'    => $request->tratamiento,
        ]);

        return redirect()->route('consultas.index')->with('success', 'Consulta registrada correctamente.');
    }

    public function receta(Consulta $consulta)
    {
        $consulta->load('mascota.dueno', 'veterinario');
        $clinica = ConfiguracionSistema::first();

        // Convertir firma a base64 para el PDF
        $firmaBase64 = null;
        if ($consulta->veterinario && $consulta->veterinario->foto_firma) {
            $path = storage_path('app/public/' . $consulta->veterinario->foto_firma);
            if (file_exists($path)) {
                $tipo = mime_content_type($path);
                $firmaBase64 = 'data:' . $tipo . ';base64,' . base64_encode(file_get_contents($path));
            }
        }

        $pdf = Pdf::loadView('modules.consultas.receta_pdf', compact('consulta', 'clinica', 'firmaBase64'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('receta-' . $consulta->id . '.pdf');
    }

    public function subirFirma(Request $request)
    {
        $request->validate([
            'firma' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $vet  = Auth::user()->veterinario;
        if (!$vet) return back()->with('error', 'Sin perfil de veterinario.');

        if ($vet->foto_firma) {
            Storage::disk('public')->delete($vet->foto_firma);
        }

        $path = $request->file('firma')->store('firmas', 'public');
        $vet->update(['foto_firma' => $path]);

        return back()->with('success', 'Firma actualizada correctamente.');
    }
}
