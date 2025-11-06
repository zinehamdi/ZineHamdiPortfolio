<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

class LogVisit
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            if (!str_starts_with($request->path(), 'admin')) {
                Visit::create([
                    'ip' => $request->ip(),
                    'user_agent' => substr((string) $request->header('User-Agent'), 0, 500),
                    'path' => '/'.$request->path(),
                    'locale' => app()->getLocale(),
                    'referrer' => (string) $request->headers->get('referer'),
                ]);
            }
        } catch (\Throwable $e) {
            // swallow logging errors
        }

        return $response;
    }
}
