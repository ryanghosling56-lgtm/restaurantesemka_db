<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
     protected $fillable = [
        'email',
        'password',
        'name',
        'no_hp',
        'status',
        'alamat',
    ];

    public function transaksi()
    {
        return $this->hasMany(transaksi::class, 'pelanggan_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->status === 'admin';

    }

}
