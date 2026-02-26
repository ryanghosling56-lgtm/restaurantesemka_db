<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    protected $table = 'meja';
    protected $guarded = [];

public function meja()
    {
        return $this->hasMany(transaksi::class, 'meja_id');
    }
}
