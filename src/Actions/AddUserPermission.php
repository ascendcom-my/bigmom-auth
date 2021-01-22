<?php

namespace Bigmom\Auth\Actions;

use Bigmom\Auth\Facades\Permission;
use Bigmom\Auth\Models\BigmomUserPermission;
use Bigmom\Auth\Popo\Status;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AddUserPermission
{
    protected $user;

    public function run(array $input): Status
    {
        $this->validate($input);

        $userPerm = new BigmomUserPermission;
        $userPerm->user_type = $input['model'];
        $userPerm->user_id = $this->user->id;
        $userPerm->permission = $input['permission'];
        $userPerm->save();

        return $userPerm->id
            ? new Status(0, "Permission successfully added.")
            : new Status(1, "An error occured.");
    }

    public function validate(array $input)
    {
        $validator = Validator::make($input, [
            'identifier' => ['required', 'string', 'max:191'],
            'model' => ['required', 'string', 'max:191'],
            'permission' => ['required', 'string', 'max:191', Rule::in(Permission::getPermissionList())],
        ]);
        $validator->validate();

        $model = $input['model'];

        if (!class_exists($input['model'])) {
            throw new ValidationException($validator, response("Model $model not found.", 404));
        }

        $field = config('bigmom-auth.user-identifier');
        $user = $model::where($field, $input['identifier'])->first();
        if ($user) {
            $this->user = $user;
        } else {
            $tableName = (new $model)->getTable();
            Validator::make($input, [
                'identifier' => ["exists:$tableName,$field"]
            ])->validate();
        }
    }
}
