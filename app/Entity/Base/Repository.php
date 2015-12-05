<?php

namespace NeoShop\Entity\Base;

use Illuminate\Container\Container as App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use NeoShop\Entity\Base\Exception\RepositoryException;
use Vinelab\NeoEloquent\Eloquent\Builder;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param App $app
     *
     * @throws RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeBuilder();
    }

    /**
     * Specify Model class name
     */
    abstract function model() : string;

    /**
     * @param array $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']) : Collection
    {
        return $this->builder->get($columns);
    }

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*']) : LengthAwarePaginator
    {
        return $this->builder->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data) : Model
    {
        /** @var Model $model */
        $model = $this->app->make($this->model());
        $model->update($data);

        return $model;
    }

    /**
     * @param array  $data
     * @param        $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->builder->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->builder->find($id)->delete();
    }

    /**
     * @param       $id
     * @param array $columns
     *
     * @return Collection
     */
    public function find($id, $columns = ['*']) : Collection
    {
        return $this->builder->find($id, $columns);
    }

    /**
     * @param       $attribute
     * @param       $value
     * @param array $columns
     *
     * @return Model|null
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->builder->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return Builder
     * @throws RepositoryException
     */
    public function makeBuilder() : Builder
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->builder = $model->newQuery();
    }
}