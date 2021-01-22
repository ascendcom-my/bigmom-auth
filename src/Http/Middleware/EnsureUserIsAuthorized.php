<?php

namespace Bigmom\Auth\Http\Middleware;

use Bigmom\Auth\Facades\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthorized
{
    /**
     * Ensures the user is authorized to access poll.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission)
    {
        if (Permission::allows(Auth::guard('bigmom')->user(), $permission)) {
            return $next($request);
        } else {
            abort(403, "User is not authorized to access this link. Are you sure you are accessing the correct link?");
        }
    }
}
