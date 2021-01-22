<?php

namespace Bigmom\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('bigmom')->user()) {
            return redirect()->route('bigmom-auth.getLogin', [
                'requested' => $request->url(),
            ]);
        }

        return $next($request);
    }
}
