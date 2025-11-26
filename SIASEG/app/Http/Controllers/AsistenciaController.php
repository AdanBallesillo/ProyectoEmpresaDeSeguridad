<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    public function registrar(Request $request)
{
    $empleado_id = Auth::user()->id_empleado;

    $turno_id = 1;
    $estacion_id = null;

    $hoy = Carbon::now()->format('Y-m-d');

    $yaExiste = Asistencia::where('empleado_id', $empleado_id)
        ->whereDate('fecha_registro', $hoy)
        ->exists();

    if ($yaExiste) {
        return response()->json([
            'mensaje' => 'Ya registraste tu asistencia hoy'
        ]);
    }

    Asistencia::create([
        'empleado_id' => $empleado_id,
        'turno_id' => $turno_id,
        'estacion_id' => $estacion_id,
        'status_asistencia' => 'A tiempo',
        'STATUS' => 'Activo',
        'fecha_registro' => Carbon::now()
    ]);

    return response()->json([
        'mensaje' => 'Asistencia registrada correctamente ✔'
    ]);
}

public function guardarFoto(Request $request)
{
    $foto = $request->foto;

    // Decodificar base64
    $imagen = str_replace('data:image/png;base64,', '', $foto);
    $imagen = str_replace(' ', '+', $imagen);
    $imagenBinaria = base64_decode($imagen);

    $nombre = 'foto_' . time() . '.png';
    $ruta = public_path('fotos_asistencias/' . $nombre);

    file_put_contents($ruta, $imagenBinaria);

    return response()->json([
        'mensaje' => 'Foto guardada',
        'ruta' => $nombre
    ]);
}

    
}
