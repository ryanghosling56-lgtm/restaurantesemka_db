<?php

namespace App\Filament\Resources\DetailTransaksis;

use App\Filament\Resources\DetailTransaksis\Pages\CreateDetailTransaksi;
use App\Filament\Resources\DetailTransaksis\Pages\EditDetailTransaksi;
use App\Filament\Resources\DetailTransaksis\Pages\ListDetailTransaksis;
use App\Filament\Resources\DetailTransaksis\Schemas\DetailTransaksiForm;
use App\Filament\Resources\DetailTransaksis\Tables\DetailTransaksisTable;
use App\Models\detail_transaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DetailTransaksiResource extends Resource
{
    protected static ?string $model = detail_transaksi::class;
    protected static ?string $pluralModelLabel = 'Detail Transaksi';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

   // protected static ?string $recordTitleAttribute = 'detail_transaksi';

    protected static string|UnitEnum|null $navigationGroup = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return DetailTransaksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DetailTransaksisTable::configure($table);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDetailTransaksis::route('/'),
           // 'create' => CreateDetailTransaksi::route('/create'),
            'edit' => EditDetailTransaksi::route('/{record}/edit'),
        ];
    }
}
