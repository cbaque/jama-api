<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\DocumentsCabeceraExport;
use App\Exports\DocumentsConstruccionExport;
use App\Exports\DocumentsGeneralExport;
use App\Exports\DocumentsPhotoExport;


class DocumentsExport implements WithMultipleSheets
// FromCollection, Responsable, WithHeadings, WithMapping, WithTitle, WithMultipleSheets
{
    use Exportable;


    protected $id;
    protected $sheets;


     function __construct($id) {
        $this->id = $id;
     }


    public function sheets(): array
    {
        $sheets = [
            new DocumentsCabeceraExport($this->id),
            new DocumentsConstruccionExport($this->id, 'TIPO_CONSTRUCCION', 'Tipo de Construcción'),
            new DocumentsConstruccionExport($this->id, 'TIPO_EDUCACION', 'Tipo de Ocupación'),
            new DocumentsGeneralExport($this->id, 'AMENAZA_GENERAL', 'Amenaza general'),
            new DocumentsGeneralExport($this->id, 'AMENAZA_ESTRUCTURAL', 'Amenaza estructurales'),
            new DocumentsGeneralExport($this->id, 'AMENAZA_NO_ESTRUCTURAL', 'Amenaza no estructurales'),
            new DocumentsGeneralExport($this->id, 'AMENAZA_GEOTECNICA', 'Amenaza geotécnicas'),
            new DocumentsPhotoExport($this->id),
        ];

        return $sheets;
    }
}
