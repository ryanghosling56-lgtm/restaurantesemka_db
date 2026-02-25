<?php

namespace App\Filament\Resources\Menus\RelationManagers;

use App\Filament\Resources\DetailTransaksis\DetailTransaksiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class DetailTransaksiRelationManager extends RelationManager
{
    protected static string $relationship = 'detail_transaksi';

    protected static ?string $relatedResource = DetailTransaksiResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
