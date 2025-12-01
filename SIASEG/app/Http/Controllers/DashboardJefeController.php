<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Transporte;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardJefeController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        // =========================
        //  ASISTENCIAS HOY (COLUMNA IZQUIERDA)
        // =========================
        $asistenciasHoy = Asistencia::query()
            ->leftJoin('empleados', 'asistencias.empleado_id', '=', 'empleados.id_empleado')
            ->leftJoin('estaciones', 'asistencias.estacion_id', '=', 'estaciones.id_estacion')
            ->whereDate('asistencias.fecha_registro', $hoy)
            ->select(
                'asistencias.*',
                'empleados.nombres',
                'empleados.apellidos',
                'estaciones.nombre_estacion'
            )
            ->orderBy('asistencias.hora_entrada', 'asc')
            ->get();

        // Presentes hoy: todos los que NO son falta
        $presentesHoy = Asistencia::whereDate('fecha_registro', $hoy)
            ->where('status_asistencia', '!=', 'Falta')
            ->count();

        // Llegadas tarde hoy
        $llegadasTardeHoy = Asistencia::whereDate('fecha_registro', $hoy)
            ->where('status_asistencia', 'Tarde')
            ->count();

        // Unidades activas
        $unidadesActivas = Transporte::where('status', 'Activo')
            ->where('disponible', 1)
            ->count();

        // =========================
        //  ESTADO DE ESTACIONES (COLUMNA DERECHA)
        // =========================
        $estacionesBD = DB::table('estaciones')
            ->where('status', 'Activo')
            ->orderBy('nombre_estacion')
            ->get();

        $estaciones = $estacionesBD->map(function ($estacion) use ($hoy) {

            $requerido = (int) ($estacion->p_requerido ?? 0);

            // Cuántos empleados están asignados hoy a esa estación
            $asignado = DB::table('asignaciones_turnos')
                ->where('id_estacion', $estacion->id_estacion)
                ->count();

            // Porcentaje para la barra
            $porcentaje = $requerido > 0
                ? min(100, round(($asignado / $requerido) * 100))
                : 0;

            $estacion->personal_asignado    = $asignado;
            $estacion->porcentaje_ocupacion = $porcentaje;

            return $estacion;
        });

        // Alertas
        $alertas = $this->generarAlertas($hoy);

        // IMPORTANTE: enviamos también $estaciones
        return view('Jefe.IndexDashboard', compact(
            'asistenciasHoy',
            'alertas',
            'presentesHoy',
            'llegadasTardeHoy',
            'unidadesActivas',
            'estaciones'
        ));
    }

    protected function generarAlertas($hoy)
    {
        $faltasHoy = Asistencia::whereDate('fecha_registro', $hoy)
            ->where('status_asistencia', 'Falta')
            ->count();

        $llegadasTardeHoy = Asistencia::whereDate('fecha_registro', $hoy)
            ->where('status_asistencia', 'Tarde')
            ->count();

        $alertas = [];

        if ($faltasHoy > 0) {
            $alertas[] = [
                'tipo'    => 'danger',
                'titulo'  => "Faltas registradas hoy: {$faltasHoy}",
                'mensaje' => 'Hay ausencias registradas, revisa si cuentan con justificante.'
            ];
        }

        if ($llegadasTardeHoy > 0) {
            $alertas[] = [
                'tipo'    => 'warning',
                'titulo'  => "Llegadas tarde hoy: {$llegadasTardeHoy}",
                'mensaje' => 'Hay retrasos registrados, valida qué estaciones están siendo afectadas.'
            ];
        }

        if ($faltasHoy === 0 && $llegadasTardeHoy === 0) {
            $alertas[] = [
                'tipo'    => 'success',
                'titulo'  => 'Sin incidencias de asistencia',
                'mensaje' => 'No hay faltas ni retardos hoy. Buen trabajo del personal.'
            ];
        }

        return $alertas;
    }
}
