<?php

namespace Bigmom\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BigmomUserPermission extends Model
{
    use HasFactory;

    protected $table = 'bigmom_user_permission';

    public function user()
    {
        return $this->morphTo();
    }
}
