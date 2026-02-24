<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'RestaurantESEMKA';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema)

            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->maxLength(100)
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->visibleOn('create')
                    ->required()
                    ->maxLength(100),
                TextInput::make('no_hp')
                    ->tel()
                    ->required()
                    ->maxLength(12),
                Select::make('status')
                    ->options([ 'admin' => 'Admin', 'pelanggan' => 'Pelanggan'])
                    ->hiddenOn('edit')
                    ->required(),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
            ]);


    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table)
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('no_hp')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ]);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
