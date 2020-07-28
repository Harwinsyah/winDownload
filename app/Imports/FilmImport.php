<?php

namespace App\Imports;

use App\Film;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FilmImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Film([
            'judul'         => $row['judul'],
            'desc'          => $row['desc'],
            'tahun'         => $row['tahun'],
            'kualitas'      => $row['kualitas'],
            'genre'         => $row['genre'],
            'jenis'         => $row['jenis'],
            'status'        => $row['status'],
            'penyimpanan'   => $row['penyimpanan'],
            'ukuran'        => $row['ukuran'],
            'rating'        => $row['rating'],
            'episode'       => $row['episode'],
            'subtitle'      => $row['subtitle'],
            'negara'        => $row['negara'],
            'sinopsis'      => $row['sinopsis'],
            'release'       => $row['release'],
            'ket'           => $row['ket'],
            'sub_link'      => $row['sub_link'],
            'film_link'     => $row['film_link']
        ]);
    }
}
