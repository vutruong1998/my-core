<?php

namespace MyCore\Core\Repositories;

use MyCore\Core\Repositories\BaseRepositoryEloquent;
use MyCore\Core\Repositories\RoleRepository;
use MyCore\Core\Models\Role;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class RoleRepositoryEloquent
 * @package namespace MyCore\Core\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepositoryEloquent implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
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
