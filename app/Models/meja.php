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

        
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'meja_id');
    }
}
