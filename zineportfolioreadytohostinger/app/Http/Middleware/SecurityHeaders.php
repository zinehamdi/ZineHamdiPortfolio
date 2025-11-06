<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (!env('SECURITY_HEADERS', true)) {
            return $response;
        }
    $isLocal = app()->environment('local');

    // In local, allow generic http/ws schemes to support Vite dev server on any host/port (e.g., 127.0.0.1:5173 or random ports)
    if ($isLocal) {
            $scriptSrc = "'self' 'unsafe-inline' http: https:";
            $styleSrc  = "'self' 'unsafe-inline' http: https:";
            $imgSrc    = "'self' data: blob: http: https:";
            $connectSrc= "'self' http: https: ws: wss:";
            $fontSrc   = "'self' http: https: data:";
        } else {
            $scriptSrc = "'self' 'unsafe-inline' https:";
            $styleSrc  = "'self' 'unsafe-inline' https:";
            $imgSrc    = "'self' data: blob: https:";
            $connectSrc= "'self' https: wss:";
            $fontSrc   = "'self' https: data:";
        }

        $csp = "default-src 'self' https: data: blob:; script-src {$scriptSrc}; style-src {$styleSrc}; img-src {$imgSrc}; connect-src {$connectSrc}; font-src {$fontSrc}; frame-ancestors 'self';";
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), camera=(), microphone=()');
        $response->headers->set('Content-Security-Policy', $csp);
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }
        return $response;
    }
}
