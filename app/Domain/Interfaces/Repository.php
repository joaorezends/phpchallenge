<?php

namespace App\Domain\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * @return string
     */
    public function getModelClass(): string;

    /**
     * @param  array $attributes
     * @return Model
     */
    public function store(array $attributes): Model;
}
