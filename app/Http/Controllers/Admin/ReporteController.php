<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mascota;
use App\Models\Veterinario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    private function datos(): array
    {
        return [
            'totalUsuarios'      => User::count(),
            'totalAdmins'        => User::where('role', 'administrador')->count(),
            'totalVeterinarios'  => User::where('role', 'veterinario')->count(),
            'totalMascotas'      => Mascota::count(),
            'totalConsultas'     => DB::table('consultas')->count(),
            'actividadVets'      => Veterinario::withCount('consultas')->orderByDesc('consultas_count')->get(),
            'consultasPorMes'    => DB::table('consultas')
                ->selectRaw("DATE_FORMAT(fecha_consulta, '%Y-%m') as mes, COUNT(*) as total")
                ->where('fecha_consulta', '>=', now()->subMonths(6))
                ->groupByRaw("DATE_FORMAT(fecha_consulta, '%Y-%m')")
                ->orderBy('mes')
                ->get(),
            'mascotasPorEspecie' => Mascota::selectRaw('especie, COUNT(*) as total')
                ->whereNotNull('especie')
                ->groupBy('especie')
                ->orderByDesc('total')
                ->get(),
        ];
    }

    public function index()
    {
        return view('modules.admin.reportes.index', $this->datos());
    }

    public function exportarPdf()
    {
        $datos = $this->datos();
        $datos['fecha'] = now()->translatedFormat('d \d\e F \d\e Y');

        $pdf = Pdf::loadView('modules.admin.reportes.pdf', $datos)
            ->setPaper('a4', 'portrait');

        return $pdf->download('reporte-veterinaria-' . now()->format('Y-m-d') . '.pdf');
    }
}
