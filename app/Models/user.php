<?php

namespace App\Models;

use Illuminate\foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
     protected $fillable = [

    'email',
    'password',
    'name',
    'alamat',
    'no_hp',
    'status',
    ];

    public function transaksi()
    {
        return $this->hasMany(transaksi::class, 'pelanggan_id');
    }
}
