<?php

namespace MyCore\Core\Repositories;

use MyCore\Core\Models\Permission;
use MyCore\Core\Repositories\BaseRepositoryEloquent;
use MyCore\Core\Repositories\PermissionRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace MyCore\Core\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepositoryEloquent implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
