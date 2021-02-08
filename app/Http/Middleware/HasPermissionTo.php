<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasPermissionTo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
		if(!auth()->user()->isSuperAdmin() && !auth()->user()->hasPermission($permission)) {
			abort(403);
		}

        return $next($request);
    }
}
