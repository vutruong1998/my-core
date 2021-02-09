<?php

namespace MyCore\Core\Repositories;

/**
 * Interface UserRepository
 * @package namespace MyCore\Core\Repositories;
 */
interface UserRepository extends BaseRepository
{
    public function datatable(array $with = []);
}
