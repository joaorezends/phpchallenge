<?php

namespace App\Domain\People\Services;

use App\Domain\People\Interfaces\Services\PersonService;
use App\Domain\People\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Domain\People\Jobs\StorePersonJob;
use App\Support\Xml;
use Exception;

class UploadedFileService implements IUploadedFileService
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->personService = app()->make(PersonService::class);
    }

    /**
     * @param  string $contents
     * @return bool
     */
    public function validate(string $contents): bool
    {
        try {
            $people = $this->parse($contents);

            foreach ($people as $person) {
                if (! $this->personService->validate($person)) {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param  string $contents
     * @return void
     */
    public function store($contents): void
    {
        if ($this->validate($contents)) {
            $people = $this->parse($contents);
            
            foreach ($people as $person) {
                StorePersonJob::dispatch($person);
            }
        }
    }

    /**
     * @param  string $contents
     * @return array
     */
    private function parse($contents): array
    {
        $xml = simplexml_load_string($contents);
        $people = (new Xml($xml))->toArray();
        $people = $people["person"];

        $people = array_map(function ($person) {
            $return = [
                "id" => $person["personid"],
                "name" => $person["personname"]
            ];

            $phones = $person["phones"]["phone"];
            $phones = is_array($phones) ? $phones : [ $phones ];

            $return["phones"] = array_map(function ($phone) {
                return ["number" => $phone];
            }, $phones);

            return $return;
        }, $people);

        return $people;
    }
}
