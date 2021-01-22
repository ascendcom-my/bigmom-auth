<?php

namespace Bigmom\Auth\Http\Controllers;

use Bigmom\Auth\Actions\AddUserPermission;
use Bigmom\Auth\Actions\RemoveUserPermission;
use Bigmom\Auth\Facades\Permission;
use Bigmom\Auth\Models\BigmomUserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class PermissionController extends Controller
{
    public function getIndex()
    {
        return view('bigmom-auth::permission.index', [
            'userPerms' => BigmomUserPermission::get(),
            'defaultModel' => get_class(Auth::guard('bigmom')->user()),
            'perms' => Permission::getPermissionList(),
        ]);
    }

    public function postCreate(Request $request)
    {
        $status = (new AddUserPermission)->run($request->input());

        return $status->code() == 0
            ? redirect()
                ->back()
                ->with('success', $status->message())
            : redirect()
                ->back()
                ->withErrors('error', 'An error occured.');
    }

    public function postDelete(Request $request)
    {
        $status = (new RemoveUserPermission)->run($request->input());

        return $status->code() == 0
            ? redirect()
                ->back()
                ->with('success', $status->message())
            : redirect()
                ->back()
                ->withErrors('error', 'An error occured.');
    }
}
