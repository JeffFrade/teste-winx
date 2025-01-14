<?php

namespace App\Core\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Closure;

/**
 * @codeCoverageIgnore
 */
class RedirectWithoutPermission
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->cannot('admin')) {
            abort(403);
        }

        return $next($request);
    }
}
