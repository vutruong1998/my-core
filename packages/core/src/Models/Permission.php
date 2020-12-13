<?php
namespace MyCore\Core\Models;

use Spatie\Permission\Models\Permission as BasePermission;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends BasePermission implements Transformable
{
    use TransformableTrait;

    public function getDisplayNameAttribute($value)
    {
        return $value ?: $this->name;
    }
}
