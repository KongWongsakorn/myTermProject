<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        foreach ($roles as $role) {
            if ($user->hasRoles($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
