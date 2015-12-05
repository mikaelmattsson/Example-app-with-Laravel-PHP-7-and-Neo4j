<?php

namespace NeoShop\Entity\Base;

use Illuminate\Container\Container as App;
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
    protected $model;

    /**
     * @param App $app
     *
     * @throws RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
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
        return $this->model->get($columns);
    }

    /**
     * @param int   $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
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
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param       $id
     * @param array $columns
     *
     * @return Model|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
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
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return Builder
     * @throws RepositoryException
     */
    public function makeModel() : Builder
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model->newQuery();
    }
}