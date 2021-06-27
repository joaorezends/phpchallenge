<?php

namespace App\Domain\People;

use App\Domain\People\Interfaces\Services\PersonService as IPersonService;
use App\Domain\People\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Domain\People\Services\PersonService;
use App\Domain\People\Services\UploadedFileService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IPersonService::class, function () {
            return new PersonService;
        });

        $this->app->bind(IUploadedFileService::class, function () {
            return new UploadedFileService;
        });
    }
}
