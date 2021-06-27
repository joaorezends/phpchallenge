<?php

namespace App\Domain\People\Services;

use App\Domain\People\Interfaces\Services\PersonService as IPersonService;
use Illuminate\Support\Facades\Validator;

class PersonService implements IPersonService
{
    /**
     * @param  array $attributes
     * @return bool
     */
    public function validate(array $attributes): bool
    {
        $validator = Validator::make($attributes, [
            "id" => "required|integer|min:1",
            "name" => "required|max:191",
            "phones" => "required|array|min:1",
            "phones.*.number" => "required|size:7",
        ]);

        return ! $validator->fails();
    }
}
