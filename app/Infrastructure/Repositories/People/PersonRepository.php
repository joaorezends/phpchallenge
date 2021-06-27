<?php

namespace App\Infrastructure\Repositories\People;

use App\Domain\People\Entities\Person;
use App\Domain\People\Interfaces\Repositories\PersonRepository as IPersonRepository;
use App\Infrastructure\Repositories\Repository;

class PersonRepository extends Repository implements IPersonRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Person::class;
    }
}
