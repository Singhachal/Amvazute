<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class SetLocale
{
public function handle(Request $request, Closure $next)
{
// Priority: session -> cookie -> accept-language -> config
$locale = Session::get('locale') ?: Cookie::get('locale');


if (!$locale) {
// Let the browser preference decide (only if it matches available)
$available = array_keys(available_languages());
$locale = $request->getPreferredLanguage($available);
}


if ($locale) {
App::setLocale($locale);
}


return $next($request);
}
}
