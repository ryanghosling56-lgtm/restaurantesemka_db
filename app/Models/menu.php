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
        'create_at',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
