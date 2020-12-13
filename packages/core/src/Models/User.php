<?php 

namespace MyCore\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasRoles;

    protected $guard_name = 'web'; // laravel-permission

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}