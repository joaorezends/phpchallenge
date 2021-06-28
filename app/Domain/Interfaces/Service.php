<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Service
{
    /**
     * @return string
     */
    public function getRepositoryClass(): string;

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
     * @return Model
     */
    public function find(int $id): Model;

    /**
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model;
}
