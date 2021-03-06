<?php

/**
 * Example middleware.
 */

namespace App\Http\Middleware;

use Closure;

/**
 * Class ExampleMiddleware.
 *
 * @package App\Http\Middleware
 */
class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request The request.
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
