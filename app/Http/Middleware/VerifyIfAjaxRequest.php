<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIfAjaxRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax() && !$request->wantsJson()) {
            return response()->make(view('errors.404'));
        }

        return $next($request);
    }
}
