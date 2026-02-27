<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    protected $table = 'detail_transaksis';
    protected $guarded = [];


    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }   

}
