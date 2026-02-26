<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = ['id'];


    public function pelanggan()
    {
        return $this->belongsTo(user::class, 'pelanggan_id');
    }
    public function meja()
    {
        return $this->belongsTo(meja::class, 'meja_id');
    }
}

