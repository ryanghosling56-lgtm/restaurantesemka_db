<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelanggan_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('meja_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kode_booking')
                    ->searchable(),
                TextColumn::make('tgl_jam_trx')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status_transaksi')
                    ->badge(),
                TextColumn::make('nominal_dp')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('metode_pembayaran_dp')
                    ->searchable(),
                TextColumn::make('status_pembayaran_dp')
                    ->badge(),
                TextColumn::make('total_bayar')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kekurangan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('metode_pembayaran_trx')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
