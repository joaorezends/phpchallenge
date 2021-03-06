<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * @return string
     */
    public function getModelClass(): string;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param  int $id
     * @return Model|null
     */
    public function find(int $id);

    /**
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model;
}
