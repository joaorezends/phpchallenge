<?php

namespace App\Domain\People\Interfaces\Services;

interface PersonService
{
    /**
     * @param  array $attributes
     * @return bool
     */
    public function validate(array $attributes): bool;
}
