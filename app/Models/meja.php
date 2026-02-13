<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    protected $table = 'meja';
    protected $fillable = [
        'id',
        'no_meja',
        'status',
        'kapasitas',
        'created_at',

    ];
}
