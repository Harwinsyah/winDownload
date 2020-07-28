<?php

namespace App\Exports;

use App\Film;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FilmExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Film::select('judul', 'desc', 'tahun', 'kualitas', 'jenis', 'genre', 'ukuran', 'negara', 'penyimpanan', 'status', 'episode', 'rating', 'release', 'ket', 'sub_link', 'film_link')->get();
    }

    public function headings() : array
    {
        return [
            'Judul', 'Desc', 'Tahun', 'Kualitas', 'Jenis', 'Genre', 'Ukuran', 'Negara', 'Penyimpanan', 'Status', 'Episode', 'Rating', 'Release', 'Keterangan', 'Sub Link', 'Link Download'
        ];
    }
}
