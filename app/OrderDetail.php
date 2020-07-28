<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
        'invoice', 'judul', 'ukuran', 'lokasi', 'status', 'tgl', 'ket', 'link'
    ];    
}
