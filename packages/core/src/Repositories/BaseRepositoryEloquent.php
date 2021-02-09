<?php
namespace MyCore\Core\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as PrettusRepositoryEloquent;

/**
 * Class BaseRepositoryEloquent
 * @package namespace MyCore\Core\Repositories;
 */
abstract class BaseRepositoryEloquent extends PrettusRepositoryEloquent implements BaseRepository
{
    abstract public function model();

    public function datatable(array $with = [])
    {
        return $this->model->select('*')->with($with);
    }

    public function firstOrCreate(array $attributes = [], array $values = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->model->firstOrCreate($attributes, $values);
        $this->skipPresenter($temporarySkipPresenter);

        $this->resetModel();

        return $this->parserResult($model);
    }

    public function firstOrNew(array $attributes = [], array $values = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->model->firstOrNew($attributes, $values);
        $this->skipPresenter($temporarySkipPresenter);

        $this->resetModel();

        return $this->parserResult($model);
    }
}
