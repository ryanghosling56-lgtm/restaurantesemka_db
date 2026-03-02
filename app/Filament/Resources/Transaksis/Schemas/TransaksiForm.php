<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use App\Models\menu;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
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



                Section::make('Informasi Transaksi')
                    ->schema([
                        Select::make('status_transaksi')
                            ->options([
                                'pending' => 'Pending',
                                'reserved' => 'Reserved',
                                'checkin' => 'Checkin',
                                'done' => 'Done',
                                'failed' => 'Failed',
                            ])
                            ->default('pending')
                            ->required(),

                        DateTimePicker::make('tgl_jam_trx')
                            ->label('Tanggal & Jam Transaksi')
                            ->default(now())
                            ->required(),

                        TextInput::make('nominal_dp')
                            ->required()
                            ->prefix("Rp. ")
                            ->numeric()
                            ->default(0)
                            ->label('Nominal DP')
                            ->live(),

                        TextInput::make('metode_pembayaran_dp')
                            ->label('Metode Pembayaran DP')
                            ->required(),

                        Select::make('status_pembayaran_dp')
                            ->label('Status Pembayaran DP')
                            ->options([
                                'deny' => 'Deny',
                                'pending' => 'Pending',
                                'cancel' => 'Cancel',
                                'settlement' => 'Settlement',
                                'expired' => 'Expired',
                                'refund' => 'Refund',
                            ]),

                        TextInput::make('total_bayar')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Total Bayar')
                            ->live()
                            ->prefix('Rp. '),

                        TextInput::make('kekurangan')
                            ->numeric()
                            ->default(0)
                            ->label('Kekurangan')
                            ->live()
                            ->prefix('Rp. '),

                        TextInput::make('metode_pembayaran_trx')
                            ->label('Metode Pembayaran Transaksi')
                            ->required(),




                    ])
                    ->columns(2),

                Section::make('Detail Pesanan')
                    ->schema([
                        Repeater::make('detail_transaksi')
                            ->schema([
                                Select::make('menu_id')
                                    ->label('Menu')
                                    ->options(menu::all()->pluck('nama_menu', 'id'))
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        if ($state) {
                                            $menu = menu::find($state);
                                            $set('harga', $menu->harga);
                                            $qty = $get('qty') ?? 1;
                                            $set('total_harga', $menu->harga * $qty);
                                        }
                                    }),

                                TextInput::make('qty')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(1)
                                    ->live()
                                    ->afterStateUpdated(function (callable $set, ?string $state, callable $get) {
                                        $qty = $state ?? 1;
                                        $harga = $get('harga') ?? 0;
                                        $set('total_bayar', $qty * $harga);
                                    }),

                                TextInput::make('harga')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefix('Rp. '),

                                TextInput::make('total_bayar')
                                    ->label('Total Bayar')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefix('Rp. '),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->live()
                            ->afterStateUpdated(fn(callable $set, ?array $state, callable $get) => static::updateTotals($state, $set, $get)),
                    ]),



                    section::make('Pembayaran')->schema([

                        TextInput::make('kode_booking')
                            ->default(function () {
                                return 'STM-' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
                            })
                            ->dehydrated()
                            ->disabled()
                            ->required(),
                        TextInput::make('total_bayar')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->default(0)
                            ->label('Total Bayar')
                            ->prefix('Rp. '),
                    ]),
            ]);
    }
        protected static function updateTotals($state, callable $set, callable $get)
        {
            $items = collect($get('detail_transaksi'));
            $total = $items->reduce(function ($carry, $item) {
                return $carry + ($item['qty'] * $item['harga']);

            }, 0);

            $set('total_bayar', $total);
}



}
