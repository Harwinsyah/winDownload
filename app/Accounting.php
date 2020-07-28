<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    protected $table = 'accounting';
    protected $fillable = [
        'desc', 'pemasukan', 'pengeluaran', 'tgl', 'ket'
    ];
}
