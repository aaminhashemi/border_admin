<?php

namespace App\Filament\Resources\UserTypes\Pages;

use App\Filament\Resources\UserTypes\UserTypeResource;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class CreateUserType extends CreateRecord
{
    protected static string $resource = UserTypeResource::class;
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('users_type.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label(__('users_type.fields.slug'))
                    ->required()
                    ->maxLength(255),

            ]);
    }
}
