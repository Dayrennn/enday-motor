
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            // Kalau role tidak sesuai, redirect misal ke home atau 403
            return redirect('/home')->with('error', 'Anda tidak memiliki akses.');
        }

        // Role sesuai → teruskan request ke controller
        return $next($request);
    }
}
