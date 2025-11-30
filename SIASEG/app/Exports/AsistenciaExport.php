<?php

namespace App\Exports;

use App\Http\Controllers\ReporteController;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AsistenciaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $periodo;

    public function __construct($periodo)
    {
        $this->periodo = $periodo;
    }

    public function collection()
    {
        $controller = new ReporteController();
        $data = $controller->getResumenAsistencia($this->periodo);

        return collect($data);
    }

    // Encabezados de tu Excel
    public function headings(): array
    {
        return [
            'Nombre',
            'A Tiempo',
            'Tarde',
            'Falta',
            'Porcentaje'
        ];
    }

    // ESTILOS
    public function styles(Worksheet $sheet)
    {
        // Encabezados
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFill()->setFillType('solid')->getStartColor()->setARGB('FFCCE5FF');

        // Bordes para toda la tabla
        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:E{$lastRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}
