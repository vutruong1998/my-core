<?php
namespace MyCore\Core\Models;

use Spatie\Permission\Models\Role as BaseRole;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Role extends BaseRole implements Transformable
{
    use TransformableTrait;

    protected $appends = [
        'guard_name_display'
    ];

    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->name;
    }

    public function getGuardNameDisplayAttribute()
    {
        $guardName = $this->guard_name;
        $guards = config('permission.guards');
        if (!is_array($guards)) {
            $guards = [];
        }
        return $guards[$guardName] ?? $guardName;
    }
}
