<?php

namespace App\Infrastructure\Repositories\People;

use App\Domain\People\Entities\Phone;
use App\Domain\People\Interfaces\Repositories\PhoneRepository as IPhoneRepository;
use App\Infrastructure\Repositories\Repository;

class PhoneRepository extends Repository implements IPhoneRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Phone::class;
    }

    /**
     * @param  array $attributes
     * @return Phone
     */
    public function store(array $attributes): Phone
    {
        return $this->model->updateOrCreate([
            "number" => $attributes["number"],
            "person_id" => $attributes["person_id"]
        ], $attributes);
    }
}
