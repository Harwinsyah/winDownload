<?php

namespace App\Exports;

use App\Genre;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GenreExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Genre::select('nama', 'ket')->get();
    }

    public function headings() : array
    {
        return [
            'Nama', 'Keterangan'
        ];
    }
}
