<?php

namespace MyCore\Core\Repositories;

/**
 * Interface PermissionRepository
 * @package namespace MyCore\Core\Repositories;
 */
interface PermissionRepository extends BaseRepository
{
    public function datatable(array $with = []);
}
