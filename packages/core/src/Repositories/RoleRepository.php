<?php

namespace MyCore\Core\Repositories;

/**
 * Interface RoleRepository
 * @package namespace OneContent\Core\Repositories;
 */
interface RoleRepository extends BaseRepository
{
    public function datatable(array $with = []);
}
