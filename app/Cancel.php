<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    protected $table = 'cancel';
    protected $fillable = [
        'cancel', 'ket'
    ];
}