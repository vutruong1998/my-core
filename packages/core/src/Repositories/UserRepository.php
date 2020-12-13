<?php

namespace MyCore\Core\Repositories;

/**
 * Interface UserRepository
 * @package namespace OneContent\Core\Repositories;
 */
interface UserRepository extends BaseRepository
{
    public function datatable(array $with = []);
}
