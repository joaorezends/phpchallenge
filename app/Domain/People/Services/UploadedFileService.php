<?php

namespace App\Domain\People\Services;

use App\Domain\People\Interfaces\Services\PersonService;
use App\Domain\People\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Support\Xml;
use Exception;
use Illuminate\Http\UploadedFile;

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
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return bool
     */
    public function validate(UploadedFile $uploadedFile): bool
    {
        try {
            $xml = simplexml_load_file($uploadedFile->getRealPath());
            $people = (new Xml($xml))->toArray();
            $this->normalize($people);

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
     * @param  array $people
     * @return void
     */
    private function normalize(&$people): void
    {
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
    }
}
