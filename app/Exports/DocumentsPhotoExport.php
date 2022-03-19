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
use  \Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Models\DocumentPhoto as Photo;

class DocumentsPhotoExport implements WithDrawings, WithTitle, FromCollection, WithMapping
{

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

        /**
     * @return string
     */
    public function title(): string
    {
        return 'Bosquejos';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Photo::where( 'document_id', $this->id )->get();
    }    

   public function drawings()
    {
       return $this->collection()->map(function($photo, $index) {
           $drawing = new Drawing();
           // $drawing->setPath(public_path($photo->image));
           $drawing->setPath('/home/avakvldzob1w/public_html/images/'.$photo->image);
           $drawing->setHeight(250);
           $drawing->setCoordinates('B'.($index+3));
           return $drawing;
       })->toArray();

    }

        public function map($document): array
    {

        return [];
    }

}
