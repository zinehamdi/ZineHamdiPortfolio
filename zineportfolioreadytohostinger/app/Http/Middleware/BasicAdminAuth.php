<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        $user = env('ADMIN_USER', 'admin');
        $pass = env('ADMIN_PASSWORD');
        if (!$pass) {
            abort(403, 'Admin password not configured.');
        }
        if ($request->getUser() !== $user || $request->getPassword() !== $pass) {
            $headers = ['WWW-Authenticate' => 'Basic realm="Admin"'];
            return response('Unauthorized', 401, $headers);
        }
        return $next($request);
    }
}
