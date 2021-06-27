<?php

namespace App\Domain\Interfaces;

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
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model;
}
