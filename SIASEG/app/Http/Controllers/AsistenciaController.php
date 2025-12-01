<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class AsistenciaController extends Controller
{
    /**
     * Obtiene el turno asignado indefinido del empleado
     */
    private function obtenerTurnoEmpleado($empleado_id)
    {
        return DB::table('asignaciones_turnos')
            ->where('id_empleado', $empleado_id)
            ->first();
    }

    /**
     * REGISTRA ENTRADA DESDE LA HUELLA
     */
    public function registrarHuella()
    {
        $empleado_id = Auth::user()->id_empleado;
        $hoy = Carbon::today();

        $asistencia = Asistencia::where('empleado_id', $empleado_id)
            ->whereDate('fecha_registro', $hoy)
            ->first();

        // SI NO HAY REGISTRO → ES ENTRADA
        if (!$asistencia) {
            return response()->json([
                'accion' => 'entrada'
            ]);
        }

        // YA REGISTRÓ ENTRADA PERO NO SALIDA
        if ($asistencia->hora_salida === null) {
            $entrada = Carbon::parse($asistencia->hora_entrada);
            $minutos = $entrada->diffInMinutes(Carbon::now());

            // Menos de 3 min → bloquear
            if ($minutos < 3) {
                return response()->json([
                    'accion' => 'espera',
                    'faltan' => 3 - $minutos // Para que el frontend lo use si quiere
                ]);
            }

            // Ya pasaron 3 minutos → permitir salida
            return response()->json([
                'accion' => 'salida'
            ]);
        }

        // YA TIENE ENTRADA Y SALIDA
        return response()->json([
            'accion' => 'terminado'
        ]);
    }



    /**
     * GUARDAR FOTO DE ENTRADA O SALIDA
     */
    public function guardarFoto(Request $request)
    {
        try {
            $empleado_id = Auth::user()->id_empleado;
            $tipo = $request->tipo;
            $foto = $request->foto;

            if (!$tipo || !$foto) {
                return response()->json(['error' => 'Datos incompletos'], 422);
            }

            // Limpiar base64
            $imagen = str_replace('data:image/jpeg;base64,', '', $foto);
            $imagen = str_replace(' ', '+', $imagen);
            $binario = base64_decode($imagen);

            if (!$binario) {
                return response()->json(['error' => 'Imagen inválida'], 422);
            }

            // Nombre único
            $nombre = 'foto_' . $tipo . '_' . time() . '.jpg';
            $path = 'fotos_asistencias/' . $nombre;

            Storage::disk('public')->put($path, $binario);

            $hoy = Carbon::today();

            // Registrar ENTRADA
            if ($tipo === 'entrada') {

                // Obtener turno asignado al empleado
                $turnoAsignado = DB::table('asignaciones_turnos')
                    ->where('id_empleado', $empleado_id)
                    ->first();

                if (!$turnoAsignado) {
                    return response()->json(['error' => 'El empleado no tiene un turno asignado'], 400);
                }

                // Obtener estacion asignada
                $estacionAsignada = DB::table('asignaciones_turnos')
                    ->where('id_empleado', $empleado_id)
                    ->value('id_estacion');

                if (!$estacionAsignada) {
                    return response()->json(['error' => 'El empleado no tiene una estación de trabajo asignada'], 400);
                }

                // Ej: "matutino" o "nocturno"
                $claveTurno = $turnoAsignado->turno;

                // Leer configuración desde config/turnos.php
                $turnoConfig = config("turnos.$claveTurno");

                if (!$turnoConfig) {
                    return response()->json(['error' => 'Configuración de turno no encontrada'], 500);
                }

                // Hora teórica de entrada + tolerancia
                $horaEntrada = Carbon::parse($turnoConfig['entrada']);
                $tolerancia = $turnoConfig['tolerancia_minutos'];

                // Hora real de marcaje
                $horaReal = Carbon::now();

                // Comparar y determinar estado
                $status = $horaReal->lessThanOrEqualTo($horaEntrada->copy()->addMinutes($tolerancia))
                    ? 'A tiempo'
                    : 'Tarde';

                Asistencia::create([
                    'empleado_id' => $empleado_id,
                    'turno_id' => $turnoAsignado->id,
                    'estacion_id' => $estacionAsignada,
                    'status_asistencia' => $status,
                    'fecha_registro' => Carbon::now(),
                    'foto_entrada' => $path,
                    'hora_entrada' => Carbon::now()->format('H:i:s'),
                ]);

                return response()->json([
                    'ok' => true,
                    'mensaje' => 'Entrada registrada'
                ]);
            }

            // Registrar SALIDA
            if ($tipo === 'salida') {
                $asistencia = Asistencia::where('empleado_id', $empleado_id)
                    ->whereDate('fecha_registro', $hoy)
                    ->first();

                if (!$asistencia) {
                    return response()->json(['error' => 'No hay entrada registrada hoy'], 404);
                }

                $asistencia->update([
                    'foto_salida' => $path,
                    'hora_salida' => Carbon::now()->format('H:i:s')
                ]);

                return response()->json([
                    'ok' => true,
                    'mensaje' => 'Salida registrada'
                ]);
            }

            return response()->json(['error' => 'Tipo inválido'], 422);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error interno',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function verificarEmpleado(Request $request)
    {
        if (Auth::user()->rol !== 'empleado') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        return $this->procesarAsistencia();
    }

    public function verificarTransportista(Request $request)
    {
        if (Auth::user()->rol !== 'Transportista') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        return $this->procesarAsistencia();
    }



    private function procesarAsistencia()
    {
        $empleado_id = Auth::user()->id_empleado;
        $hoy = Carbon::today();

        $asistencia = Asistencia::where('empleado_id', $empleado_id)
            ->whereDate('fecha_registro', $hoy)
            ->first();

        // → No tiene registro hoy → Entrada
        if (!$asistencia) {
            return response()->json(['accion' => 'entrada']);
        }

        // → Tiene entrada pero no salida
        if ($asistencia->hora_salida === null) {

            $entrada = Carbon::parse($asistencia->hora_entrada);
            $minutos = $entrada->diffInMinutes(now());

            if ($minutos < 3) {
                return response()->json([
                    'accion' => 'espera',
                    'faltan' => 3 - $minutos
                ]);
            }

            return response()->json(['accion' => 'salida']);
        }

        // → Ya realizó entrada y salida
        return response()->json(['accion' => 'terminado']);
    }


}
