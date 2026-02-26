<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use function Laravel\Prompts\select;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pelanggan_id')
                    ->required()
                    ->relationship('pelanggan', 'name')
                    ->label('Pelanggan'),

               Select::make('meja_id')
                    ->relationship('meja', 'no_meja')
                    ->required(),
                TextInput::make('kode_booking')
                    ->required(),
                DateTimePicker::make('tgl_jam_trx')
                    ->required(),
                Select::make('status_transaksi')
                    ->options([
                    'pending' => 'Pending',
                    'reserved' => 'Reserved',
                    'checkin' => 'Checkin',
                    'done' => 'Done',
                    'failed' => 'Failed',
        ])
                    ->required(),
                TextInput::make('nominal_dp')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('metode_pembayaran_dp')
                    ->required(),




                Select::make('status_pembayaran_dp')
                    ->options([

                    'deny' => 'Deny',
                    'pending' => 'Pending',
                    'cancel' => 'Cancel',
                    'settlement' => 'Settlement',
                    'expired' => 'Expired',
                    'refund' => 'Refund',
        ])
                    ->nullable(),

                TextInput::make('total_bayar')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('kekurangan')
                    ->numeric()
                    ->default(0),
                TextInput::make('metode_pembayaran_trx')
                    ->required(),
            ]);
    }
}
