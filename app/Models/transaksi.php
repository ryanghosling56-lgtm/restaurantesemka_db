<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'id',
        'pelanggan_id',
        'meja_id',
        'kode_booking',
        'tgl_jam_trx',
        'status_transaksi',
        'nominal_dp',
        'metode_pembayaran_dp',
        'status_pembayaran_dp',
        'total_bayar',
        'kekurangan',
        'metode_pembayaran_trx',
        'created_at',

    ];
}
