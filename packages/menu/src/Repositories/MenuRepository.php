<?php

namespace MyCore\Menu\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
* Interface MenuRepository
* @package namespace MyCore\Menu\Repositories;
*/
interface MenuRepository extends RepositoryInterface
{
    public function datatable(array $with = []);
}
