<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleFromRequest
{
    public function handle(Request $request, Closure $next)
    {
        $allowed = ['fa', 'ar', 'en'];

        // 1) اگر lang توی URL بود، همون رو ذخیره کن
        if ($request->filled('lang') && in_array($request->string('lang')->toString(), $allowed, true)) {
            session(['locale' => $request->string('lang')->toString()]);
        }

        // 2) هر بار قبل از رندر، locale رو از session اعمال کن
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
