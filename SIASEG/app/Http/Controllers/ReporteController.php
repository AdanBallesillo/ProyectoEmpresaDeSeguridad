<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AsistenciaExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    // GENERAR PDF
    public function generarPDF($periodo)
    {
        $asistencia = $this->getResumenAsistencia($periodo);

        $pdf = Pdf::loadView('Reportes.asistencia_pdf', [
            'asistencia' => $asistencia,
            'periodo' => $periodo
        ]);

        return $pdf->download("Reporte_Asistencia_{$periodo}.pdf");
    }

    // GENERAR EXCEL
    public function generarExcel($periodo)
    {
        return Excel::download(new AsistenciaExport($periodo), "Reporte_Asistencia_{$periodo}.xlsx");
    }

    // FUNCIÓN DEL DASHBOARD PARA MOSTRAR DATOS
    public function asistencia(Request $request)
    {
        $periodo = $request->input('periodo', 'Mes'); // default Mes

        // Obtener resumen
        $resumen = $this->getResumenAsistencia($periodo);

        return view('Jefe.IndexReportes', compact('resumen', 'periodo'));
    }


    // ================================================
    // FUNCIÓN CENTRAL — AGRUPA Y CALCULA POR EMPLEADO
    // ================================================
    public function getResumenAsistencia($periodo)
    {
        $query = DB::table('asistencias')
            ->join('empleados', 'empleados.id_empleado', '=', 'asistencias.empleado_id')
            ->select(
                'empleados.id_empleado',
                'empleados.nombres',
                'empleados.apellidos',
                'asistencias.status_asistencia',
                'asistencias.fecha_registro'
            );

        // FILTROS
        if ($periodo === 'Semana') {
            $query->whereBetween('asistencias.fecha_registro', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($periodo === 'Mes') {
            $query->whereYear('asistencias.fecha_registro', now()->year)
                ->whereMonth('asistencias.fecha_registro', now()->month);
        } elseif ($periodo === 'Año') {
            $query->whereYear('asistencias.fecha_registro', now()->year);
        }

        $data = $query->get();

        // === AGRUPAR POR EMPLEADO ===
        $grouped = $data->groupBy('id_empleado')->map(function ($items) {

            $aTiempo = $items->where('status_asistencia', 'A tiempo')->count();
            $tarde   = $items->where('status_asistencia', 'Tarde')->count();
            $falta   = $items->where('status_asistencia', 'Falta')->count();

            $total = $aTiempo + $tarde + $falta;
            $porcentaje = $total == 0 ? 0 : round(($aTiempo / $total) * 100);

            return [
                'nombre' => $items->first()->nombres . ' ' . $items->first()->apellidos,
                'a_tiempo' => $aTiempo,
                'tarde' => $tarde,
                'falta' => $falta,
                'porcentaje' => $porcentaje,
            ];
        });

        return $grouped->values(); // regresar como lista
    }
}
