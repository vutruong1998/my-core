<?php

namespace MyCore\Core\Repositories;

use Illuminate\Support\Facades\DB;
use MyCore\Core\Repositories\BaseRepositoryEloquent;
use MyCore\Core\Repositories\UserRepository;
use MyCore\Core\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 * @package namespace MyCore\Core\Repositories;
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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

    public function datatable(array $with = [])
    {
        return $this->model->with($with)->orderBy('position');
    }

    public function massUpdate(array $array = [])
    {
        $table = $this->model::getModel()->getTable();
        $caseString = 'case id';
        $ids = '';
        foreach ($array as $value) {
            $id = $value['id'];
            $position = $value['position'];
            $caseString .= " when $id then $position";
            $ids .= " $id,";
        }
        $ids = trim($ids, ',');
        DB::update("update $table set position = $caseString end where id in ($ids)");
    }
}
