<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('users.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->label(__('users.fields.last_name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('user_name')
                    ->label(__('users.fields.user_name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label(__('users.fields.email'))
                    ->email()
                    ->required()
                    ->unique(User::class, 'email'),

                TextInput::make('password')
                    ->label(__('users.fields.password'))
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('password_confirmation'),

                TextInput::make('password_confirmation')
                    ->label(__('users.fields.password_confirmation'))
                    ->password()
                    ->required(),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}
