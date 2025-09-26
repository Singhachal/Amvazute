<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class LocaleController extends Controller
{
public function setLocale(string $locale)
{
// Validate requested locale against available list
$available = array_keys(available_languages());
if (!in_array($locale, $available)) {
$locale = config('app.fallback_locale', 'en');
}


// Save to session and cookie
Session::put('locale', $locale);
Cookie::queue('locale', $locale, 60 * 24 * 30); // 30 days


// Optionally set immediately for current request
App::setLocale($locale);


return redirect()->back();
}
}
