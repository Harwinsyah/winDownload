<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situs extends Model
{
    protected $table = 'situs';
    protected $fillable = [
        'nama', 'jenis', 'link', 'ket'
    ];
}
