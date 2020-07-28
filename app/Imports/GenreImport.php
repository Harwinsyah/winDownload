<?php

namespace App\Imports;

use App\Genre;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GenreImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Genre([
            'nama'  => $row['nama'],
            'ket'   => $row['ket']
        ]);
    }
}
