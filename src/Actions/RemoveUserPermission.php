<?php

namespace Bigmom\Auth\Actions;

use Bigmom\Auth\Models\BigmomUserPermission;
use Bigmom\Auth\Popo\Status;
use Illuminate\Support\Facades\Validator;

class RemoveUserPermission
{
    public function run(array $input): Status
    {
        BigmomUserPermission::find($input['model_id'])->delete();

        return new Status(0, "Permission successfully removed.");
    }

    public function validate(array $input)
    {
        Validator::make($input, [
            'model_id' => ['required', 'exists:bigmom_user_permission,id'],
        ])->validate();
    }
}
