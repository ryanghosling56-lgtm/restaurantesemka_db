<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->password()
                    ->required(),
                TextInput::make('name'),
                TextInput::make('no_hp'),
                Select::make('status')
                    ->options(['admin' => 'Admin', 'pelanggan' => 'Pelanggan'])
                    ->required(),
                Textarea::make('alamat')
                    ->label('Alamat'),

            ]);
    }
}
