<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    protected $table = 'mejas';
    protected $guarded = [];

public function meja()
    {
        return $this->hasMany(transaksi::class, 'meja_id');
    }
}
