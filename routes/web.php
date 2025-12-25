<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/admin/locale/{locale}', function (Request $request, string $locale) {
    abort_unless(in_array($locale, ['fa', 'ar', 'en']), 404);

    session(['locale' => $locale]);

    return back();
})->name('locale.set');
