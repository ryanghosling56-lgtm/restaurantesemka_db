<?php

namespace App\Filament\Resources\Mejas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use function Laravel\Prompts\select;

class MejaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no_meja')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->options(['kosong' => 'Kosong', 'dipesan' => 'Dipesan', 'terisi' => 'Terisi'])
                    ->required(),
                TextInput::make('kapasitas')
                    ->required()
                    ->numeric()
                    ->default(2),
            ]);
    }
}
