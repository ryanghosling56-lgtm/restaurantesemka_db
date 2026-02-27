<?php

namespace App\Filament\Resources\DetailTransaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailTransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('transaksi.kode_booking')
                    ->searchable(),
                // TextColumn::make('menu.nama_menu')
                //     ->searchable(),
                // TextColumn::make('qty')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('harga_satuan')
                //     ->money('IDR', locale: 'id')
                //     ->sortable(),
                TextColumn::make('subtotal')
                    ->money('IDR', locale: 'id')
                    ->getStateUsing(function ($record) {
                        return $record->qty * $record->harga;
                    })
                    ->sortable(),
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
