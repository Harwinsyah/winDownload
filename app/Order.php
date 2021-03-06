<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'invoice', 'tgl', 'nama_pelanggan', 'ukuran', 'bayar', 'status', 'ket'
    ];

    use SoftDeletes;
}
