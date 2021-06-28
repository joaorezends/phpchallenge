<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Interfaces\Repository as IRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements IRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return void
     */
    public function __construct() {
        $this->model = app()->make($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract public function getModelClass(): string;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param  int $id
     * @return Model|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->model->updateOrCreate(["id" => $attributes["id"] ?? null], $attributes);
    }
}
