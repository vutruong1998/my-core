<?php

namespace MyCore\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasRoles;

    protected $guard_name = 'web'; // laravel-permission

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'active'
    ];
}
