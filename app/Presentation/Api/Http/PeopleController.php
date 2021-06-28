<?php

namespace App\Presentation\Api\Http;

use App\Domain\People\Interfaces\Services\PersonService;

class PeopleController extends Controller
{
    /**
     * @return string
     */
    public function getServiceClass(): string
    {
        return PersonService::class;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "people";
    }
}
