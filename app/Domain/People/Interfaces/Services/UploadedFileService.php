<?php

namespace App\Domain\People\Interfaces\Services;

interface UploadedFileService
{
    /**
     * @param  string $contents
     * @return bool
     */
    public function validate(string $contents): bool;

    /**
     * @param  string $contents
     * @return void
     */
    public function store($contents): void;
}
