<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Document;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DocumentsCabeceraExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
// WithEvents
{

    protected $id;

     function __construct($id) {
        $this->id = $id;
     }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Document::where( 'id', $this->id)->get();
    }

    public function title(): string
    {
        return 'Descripción de la Edificación';
    }


    public function headings(): array
    {
        return [
            'Nombre Edificación',
            'Dirección Edificación',
            '# Contacto',
            '# Pisos sobre suelo',
            '# Subsuelos',
            'Area en Planta',
            '# Residencia Habitada',
            '# Residencia No habitada',
        ];
    }

    public function map($document): array
    {

        return [
            $document->nombre_edificacion,
            $document->direccion_edificacion,
            $document->numero_contacto,
            $document->pisos_sobre_suelo,
            $document->subsuelos,
            $document->area_en_planta,
            $document->residencia_habitada,
            $document->residencia_no_habitada,
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
  
    //             $event->sheet->getDelegate()->getStyle('A1:C1')
    //                     ->getFill()
    //                     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    //                     ->getStartColor()
    //                     ->setARGB('DD4B39');
  
    //         },
    //     ];
    // }
}
