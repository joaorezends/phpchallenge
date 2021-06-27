<?php

namespace App\Domain\People\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface UploadedFileService
{
    /**
     * @param  \Illuminate\Http\UploadedFile $uploadedFile
     * @return bool
     */
    public function validate(UploadedFile $uploadedFile): bool;
}
