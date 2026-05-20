<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; }

        /* Encabezado */
        .header { border-bottom: 3px solid #4e73df; padding-bottom: 12px; margin-bottom: 16px; }
        .header table { width: 100%; }
        .clinica-nombre { font-size: 18px; font-weight: bold; color: #4e73df; }
        .clinica-datos { font-size: 10px; color: #666; margin-top: 2px; }
        .rx-logo { font-size: 42px; font-weight: 900; color: #4e73df; text-align: right; line-height: 1; }

        /* Sección info */
        .seccion { margin-bottom: 14px; }
        .seccion-titulo { font-size: 9px; font-weight: bold; color: #4e73df; text-transform: uppercase;
                          letter-spacing: 1px; border-bottom: 1px solid #e3e6f0; padding-bottom: 3px; margin-bottom: 8px; }
        .dato-row { margin-bottom: 4px; }
        .dato-label { font-weight: bold; color: #555; font-size: 10px; }
        .dato-valor { color: #222; }

        /* Grid */
        .grid-2 { width: 100%; }
        .grid-2 td { width: 50%; vertical-align: top; padding-right: 16px; }

        /* Recuadros diagnóstico/tratamiento */
        .caja { background: #f8f9fc; border: 1px solid #e3e6f0; border-radius: 6px;
                padding: 10px 12px; min-height: 60px; margin-top: 6px; font-size: 11px; line-height: 1.6; }

        /* Firma */
        .firma-area { margin-top: 40px; }
        .firma-linea { border-top: 1.5px solid #222; width: 220px; margin: 0 auto; padding-top: 6px; text-align: center; }
        .firma-img { display: block; margin: 0 auto 6px; max-height: 70px; max-width: 200px; }
        .firma-nombre { font-weight: bold; font-size: 11px; }
        .firma-cedula { font-size: 10px; color: #555; }

        /* Footer */
        .footer { margin-top: 30px; border-top: 1px solid #e3e6f0; padding-top: 8px;
                  text-align: center; font-size: 9px; color: #aaa; }

        .badge-folio { background: #4e73df; color: #fff; border-radius: 4px;
                       padding: 2px 8px; font-size: 10px; font-weight: bold; }
    </style>
</head>
<body>

    {{-- ENCABEZADO --}}
    <div class="header">
        <table>
            <tr>
                <td style="width:70%;vertical-align:top;">
                    <div class="clinica-nombre">
                        {{ $clinica->nombre_clinica ?? 'Clínica Veterinaria' }}
                    </div>
                    <div class="clinica-datos">
                        @if ($clinica && $clinica->direccion_fisica) 📍 {{ $clinica->direccion_fisica }} &nbsp; @endif
                        @if ($clinica && $clinica->telefono_contacto) 📞 {{ $clinica->telefono_contacto }} @endif
                    </div>
                </td>
                <td style="width:30%;text-align:right;vertical-align:top;">
                    <div class="rx-logo">℞</div>
                    <div style="text-align:right;margin-top:4px;">
                        <span class="badge-folio">Folio #{{ $consulta->id }}</span>
                    </div>
                </td>
            </tr>
        </table>
        <div style="text-align:right;font-size:10px;color:#888;margin-top:4px;">
            Fecha: {{ \Carbon\Carbon::parse($consulta->fecha_consulta)->translatedFormat('d \d\e F \d\e Y') }}
        </div>
    </div>

    {{-- DATOS DEL PACIENTE Y PROPIETARIO --}}
    <table class="grid-2">
        <tr>
            <td>
                <div class="seccion">
                    <div class="seccion-titulo">Datos del Paciente</div>
                    <div class="dato-row"><span class="dato-label">Nombre: </span><span class="dato-valor">{{ $consulta->mascota->nombre ?? '—' }}</span></div>
                    <div class="dato-row"><span class="dato-label">Especie: </span><span class="dato-valor">{{ $consulta->mascota->especie ?? '—' }}</span></div>
                    <div class="dato-row"><span class="dato-label">Raza: </span><span class="dato-valor">{{ $consulta->mascota->raza ?? '—' }}</span></div>
                    <div class="dato-row"><span class="dato-label">Sexo: </span><span class="dato-valor">{{ $consulta->mascota->sexo ?? '—' }}</span></div>
                    @if ($consulta->peso)
                    <div class="dato-row"><span class="dato-label">Peso: </span><span class="dato-valor">{{ $consulta->peso }} kg</span></div>
                    @endif
                    @if ($consulta->talla)
                    <div class="dato-row"><span class="dato-label">Talla: </span><span class="dato-valor">{{ $consulta->talla }} cm</span></div>
                    @endif
                </div>
            </td>
            <td>
                <div class="seccion">
                    <div class="seccion-titulo">Datos del Propietario</div>
                    <div class="dato-row"><span class="dato-label">Nombre: </span><span class="dato-valor">{{ $consulta->mascota->dueno->nombre_completo ?? '—' }}</span></div>
                    <div class="dato-row"><span class="dato-label">Teléfono: </span><span class="dato-valor">{{ $consulta->mascota->dueno->telefono ?? '—' }}</span></div>
                </div>
            </td>
        </tr>
    </table>

    {{-- DIAGNÓSTICO --}}
    <div class="seccion">
        <div class="seccion-titulo">Diagnóstico</div>
        <div class="caja">{{ $consulta->diagnostico ?: 'Sin diagnóstico registrado.' }}</div>
    </div>

    {{-- TRATAMIENTO / RECETA --}}
    <div class="seccion">
        <div class="seccion-titulo">Tratamiento / Receta</div>
        <div class="caja">{{ $consulta->tratamiento ?: 'Sin tratamiento registrado.' }}</div>
    </div>

    {{-- FIRMA --}}
    <div class="firma-area" style="text-align:center;">
        @if ($firmaBase64)
            <img src="{{ $firmaBase64 }}" class="firma-img" alt="Firma">
        @else
            <div style="height:60px;"></div>
        @endif
        <div class="firma-linea">
            <div class="firma-nombre">
                {{ $consulta->veterinario->nombre_completo ?? 'Médico Veterinario' }}
            </div>
            @if ($consulta->veterinario && $consulta->veterinario->cedula_profesional)
            <div class="firma-cedula">Cédula Prof. {{ $consulta->veterinario->cedula_profesional }}</div>
            @endif
            @if ($consulta->veterinario && $consulta->veterinario->especialidad)
            <div class="firma-cedula">{{ $consulta->veterinario->especialidad }}</div>
            @endif
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        {{ $clinica->nombre_clinica ?? 'Clínica Veterinaria' }} &mdash;
        Documento generado el {{ now()->translatedFormat('d \d\e F \d\e Y') }} &mdash;
        Solo para uso médico veterinario
    </div>

</body>
</html>
