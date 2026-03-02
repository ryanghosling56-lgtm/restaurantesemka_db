<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelanggan.name')
                    ->sortable(),
                TextColumn::make('meja.no_meja')
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
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('metode_pembayaran_dp')
                    ->searchable(),
                TextColumn::make('status_pembayaran_dp')
                    ->badge(),
                TextColumn::make('total_bayar')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('kekurangan')
                    ->money('IDR', locale: 'id')
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
                DeleteAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
