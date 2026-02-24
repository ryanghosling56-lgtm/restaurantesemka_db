<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $fillable = ['id','transaksi_id','password', 'menu_id', 'qty', 'harga',];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
        return $this->belongsTo(menu::class, 'menu_id');
    }
}
