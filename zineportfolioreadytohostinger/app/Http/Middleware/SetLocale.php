<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $routeLocale = $request->route('locale');
        $locale = $routeLocale ?: session('locale', config('app.locale'));
        if ($routeLocale && in_array($routeLocale, ['ar','en','fr'])) {
            session(['locale' => $routeLocale]);
        }
        App::setLocale($locale);
        return $next($request);
    }
}
