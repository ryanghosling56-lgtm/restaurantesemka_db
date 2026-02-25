<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'id',
        'nama_menu',
        'harga',
        'stok',
        'foto',


    ];

    public function detailTransaksi()
    {
        return $this->hasMany(detail_transaksi::class, 'menu_id');
    }
}
