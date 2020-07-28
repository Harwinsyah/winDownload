<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = [
        'nama', 'jk', 'alamat', 'hp', 'fb', 'ig', 'wa', 'ambil', 'ket', 'harga', 'ukuran'
    ];
}
