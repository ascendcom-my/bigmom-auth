<?php

namespace Bigmom\Auth\Http\Controllers;

use Bigmom\Auth\Facades\Permission;
use Bigmom\Auth\PackageList\PackageList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
 
class AuthController extends Controller
{
    public function getHome()
    {
        return view('bigmom-auth::home', [
            'packages' => Permission::getPackageList(Auth::guard('bigmom')->user()),
        ]);
    }

    public function getLogin()
    {
        return View::exists('vendor.bigmom.auth.login')
            ? view('vendor.bigmom.auth.login')
            : response("Please publish this package's vendor files first.");
    }

    public function postLogin(Request $request)
    {
        if (method_exists(Auth::guard('bigmom'), 'attempt')) {
            Auth::guard('bigmom')->attempt($request->only(['email', 'username', 'password']), true);
        } else {
            return response('attempt is not a method.');
        }

        $route = route('bigmom-auth.getHome');
        if ($request->has('requested')) {
            $route = $request->input('requested');
        }

        return Auth::guard('bigmom')->user()
            ? redirect($route)
            : redirect()
                ->back()
                ->withErrors('Invalid credentials.');
    }

    public function getLogout()
    {
        return View::exists('vendor.bigmom.auth.logout')
            ? view('vendor.bigmom.auth.logout')
            : response("Please publish this package's vendor files first.");
    }

    public function postLogout(Request $request)
    {
        if (Auth::guard('bigmom')->check()) {
            if (method_exists(Auth::guard('bigmom'), 'logout')) {
                Auth::guard('bigmom')->logout();
                return redirect()
                    ->route('bigmom-auth.getLogin', [
                        'requested' => $request->url(),
                    ]);
            } else {
                return response('logout is not a method.');
            }
        } else {
            abort(401);
        }
    }
}
