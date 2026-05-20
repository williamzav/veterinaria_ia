<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h1 { color: #4e73df; font-size: 20px; margin-bottom: 4px; }
        h2 { color: #4e73df; font-size: 14px; border-bottom: 2px solid #4e73df; padding-bottom: 4px; margin-top: 20px; }
        .subtitle { color: #888; font-size: 11px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #4e73df; color: #fff; padding: 7px 10px; text-align: left; font-size: 11px; }
        td { padding: 6px 10px; border-bottom: 1px solid #e3e6f0; font-size: 11px; }
        tr:nth-child(even) td { background: #f8f9fc; }
        .metric-row { display: table; width: 100%; margin-bottom: 16px; }
        .metric { display: table-cell; width: 20%; text-align: center; background: #f8f9fc; border: 1px solid #e3e6f0; padding: 10px 4px; border-radius: 4px; }
        .metric-num { font-size: 22px; font-weight: bold; color: #4e73df; }
        .metric-label { font-size: 9px; color: #888; text-transform: uppercase; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #aaa; border-top: 1px solid #e3e6f0; padding-top: 8px; }
        .bar-bg { background: #e3e6f0; border-radius: 4px; height: 8px; }
        .bar-fill { background: #4e73df; border-radius: 4px; height: 8px; }
    </style>
</head>
<body>

    <h1>&#x1F43E; Reporte del Sistema Veterinario</h1>
    <div class="subtitle">Generado el {{ $fecha }} &mdash; Solo uso interno</div>

    {{-- Métricas globales --}}
    <h2>Métricas Globales</h2>
    <table>
        <tr>
            <th>Indicador</th>
            <th>Total</th>
        </tr>
        <tr><td>Total Usuarios</td><td>{{ $totalUsuarios }}</td></tr>
        <tr><td>Administradores</td><td>{{ $totalAdmins }}</td></tr>
        <tr><td>Veterinarios</td><td>{{ $totalVeterinarios }}</td></tr>
        <tr><td>Mascotas Registradas</td><td>{{ $totalMascotas }}</td></tr>
        <tr><td>Total Consultas</td><td>{{ $totalConsultas }}</td></tr>
    </table>

    {{-- Actividad por veterinario --}}
    <h2>Actividad por Veterinario</h2>
    @if ($actividadVets->isEmpty())
        <p>No hay veterinarios registrados.</p>
    @else
    <table>
        <tr>
            <th>Veterinario</th>
            <th>Especialidad</th>
            <th>Cédula</th>
            <th>Consultas</th>
        </tr>
        @foreach ($actividadVets as $vet)
        <tr>
            <td>{{ $vet->nombre_completo }}</td>
            <td>{{ $vet->especialidad ?? '—' }}</td>
            <td>{{ $vet->cedula_profesional ?? '—' }}</td>
            <td>{{ $vet->consultas_count }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    {{-- Mascotas por especie --}}
    <h2>Mascotas por Especie</h2>
    @if ($mascotasPorEspecie->isEmpty())
        <p>No hay mascotas registradas.</p>
    @else
    <table>
        <tr>
            <th>Especie</th>
            <th>Total</th>
        </tr>
        @foreach ($mascotasPorEspecie as $e)
        <tr>
            <td style="text-transform:capitalize;">{{ $e->especie }}</td>
            <td>{{ $e->total }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    {{-- Consultas por mes --}}
    <h2>Consultas por Mes (últimos 6 meses)</h2>
    @if ($consultasPorMes->isEmpty())
        <p>No hay consultas registradas.</p>
    @else
    <table>
        <tr>
            <th>Mes</th>
            <th>Total Consultas</th>
        </tr>
        @foreach ($consultasPorMes as $cm)
        <tr>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $cm->mes)->translatedFormat('F Y') }}</td>
            <td>{{ $cm->total }}</td>
        </tr>
        @endforeach
    </table>
    @endif

    <div class="footer">Sistema de Gestión Veterinaria &copy; {{ date('Y') }} &mdash; Documento generado automáticamente</div>

</body>
</html>
