<?php

namespace MyCore\Core\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository
 * @package namespace MyCore\Core\Repositories;
 */
interface BaseRepository extends RepositoryInterface
{
    public function datatable(array $with = []);
    public function firstOrCreate(array $attributes = [], array $values = []);
    public function firstOrNew(array $attributes = [], array $values = []);
}
