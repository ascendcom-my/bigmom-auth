<?php

namespace Bigmom\Auth\Services;

use Bigmom\Auth\Models\BigmomUserPermission;
use Bigmom\Auth\PackageList\PackageList;
use Illuminate\Foundation\Auth\User;

class PermissionService
{
    public function allows(User $user, string $permission)
    {
        return in_array($user->{config('bigmom-auth.user-identifier', 'email')}, config('bigmom-auth.superusers', []))
            || BigmomUserPermission::where('permission', $permission)
                ->where('user_type', get_class($user))
                ->where('user_id', '*')
                ->exists()
            || BigmomUserPermission::where('user_type', get_class($user))
                ->where('user_id', $user->id)
                ->where('permission', $permission)
                ->exists();
    }

    public function denies(User $user, string $permission)
    {
        return !$this->allows($user, $permission);
    }

    public function getPackageList(User $user = null)
    {
        $packages = config('bigmom-auth.packages', []);

        if ($user) {
            foreach ($packages as $indexOne => $package) {
                foreach ($package['routes'] as $indexTwo => $route) {
                    $packages[$indexOne]['routes'][$indexTwo]['can_access'] = $this->allows($user, $route['permission']);
                }
            }
        }

        return $packages;
    }

    public function getPermissionList()
    {
        $packages = config('bigmom-auth.packages', []);

        $perms = [];

        foreach ($packages as $index => $package) {
            foreach ($package['permissions'] as $perm) {
                array_push($perms, $perm);
            }
        }

        return $perms;
    }
}
