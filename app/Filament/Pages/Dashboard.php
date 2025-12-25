<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    //protected string $view = 'filament.pages.dashboard';
    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.dashboard');
    }

    public function getTitle(): string
    {
        return __('filament.navigation.dashboard');
    }
}
