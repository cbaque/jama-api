<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\DocumentDetails;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Document;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DocumentsGeneralExport implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{

    protected $id;
    protected $type;
    protected $title;

     function __construct($id, $type, $title) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
     }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return DocumentDetails::query()->where( 'document_id', $this->id )->where('type_lista', $this->type);
    }


    public function headings(): array
    {
        return [
            'Tipo',
            'Poca/Ninguna',
            'Moderada',
            'Severa',
            'Comentarios',
        ];
    }

    public function map($document): array
    {

        return [
            $document->code_lista,
            ($document->little) ? 'Si' : '' ,
            ($document->moderate) ? 'Si' : '' ,
            ($document->severe) ? 'Si' : '' ,
            $document->observation,
        ];
    }
}
