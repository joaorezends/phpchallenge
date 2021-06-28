<?php

namespace App\Domain\Shiporders\Rules;

use App\Domain\Shiporders\Interfaces\Services\UploadedFileService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

class ValidShipordersXML implements Rule
{
    /**
     * @var UploadedFileService
     */
    private $uploadedFileService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->uploadedFileService = app()->make(UploadedFileService::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! $value instanceof UploadedFile) {
            return false;
        }

        return $this->uploadedFileService->validate($value->get());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O campo :attribute deve ser um arquivo xml com formato válido.";
    }
}
