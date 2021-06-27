<?php

namespace App\Domain\Abstracts;

use App\Domain\Interfaces\Repository;
use App\Domain\Interfaces\Service as IService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class Service implements IService
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @return void
     */
    public function __construct() {
        $this->repository = app()->make($this->getRepositoryClass());
    }

    /**
     * @return string
     */
    abstract public function getRepositoryClass(): string;

    /**
     * @param  array $attributes
     * @return bool
     */
    public function validate(array $attributes): bool
    {
        $validator = Validator::make($attributes, $this->rules);

        return ! $validator->fails();
    }

    /**
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model
    {
        return $this->repository->store($attributes);
    }
}