<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Service
{
    /**
     * @param  array $attributes
     * @return bool
     */
    public function validate(array $attributes): bool;

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
