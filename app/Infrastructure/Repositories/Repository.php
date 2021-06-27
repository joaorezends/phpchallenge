<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Interfaces\Repository as IRepository;
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
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->model->updateOrCreate(["id" => $attributes["id"] ?? null], $attributes);
    }
}
