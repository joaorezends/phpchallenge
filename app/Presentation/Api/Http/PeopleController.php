<?php

namespace App\Presentation\Api\Http;

use App\Domain\People\Interfaces\Services\PersonService;

class PeopleController extends Controller
{
    /**
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        parent::__construct($personService);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "people";
    }
}
