<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film';
    protected $fillable = [
        'judul', 'desc', 'tahun', 'kualitas', 'genre', 'subtitle', 'negara', 'ukuran', 'sinopsis', 'status', 'penyimpanan', 'jenis', 'episode', 'rating', 'sub_link', 'film_link', 'release', 'poster', 'ket'
    ];
}
