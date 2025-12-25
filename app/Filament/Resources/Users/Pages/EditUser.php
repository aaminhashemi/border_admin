<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
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

                TextInput::make('email')
                    ->label(__('users.fields.email'))
                    ->email()
                    ->required()
                    ->unique(
                        User::class,
                        'email',
                        ignoreRecord: true
                    ),

                TextInput::make('password')
                    ->label(__('users.fields.password'))
                    ->password()
                    ->minLength(8)
                    ->same('password_confirmation')
                    ->dehydrated(fn ($state) => filled($state))
                    ->nullable(),

                TextInput::make('password_confirmation')
                    ->label(__('users.fields.password_confirmation'))
                    ->password()
                    ->dehydrated(false)
                    ->nullable(),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (filled($data['password'] ?? null)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
