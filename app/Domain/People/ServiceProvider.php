<?php

namespace App\Domain\People;

use App\Domain\People\Interfaces\Repositories\PersonRepository as IPersonRepository;
use App\Domain\People\Interfaces\Repositories\PhoneRepository as IPhoneRepository;
use App\Domain\People\Interfaces\Services\PersonService as IPersonService;
use App\Domain\People\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Domain\People\Services\PersonService;
use App\Domain\People\Services\UploadedFileService;
use App\Infrastructure\Repositories\People\PersonRepository;
use App\Infrastructure\Repositories\People\PhoneRepository;
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
        $this->bindRepositories();
        $this->bindServices();
    }

    /**
     * @return void
     */
    public function bindRepositories(): void
    {
        $this->app->bind(IPersonRepository::class, function () {
            return new PersonRepository;
        });

        $this->app->bind(IPhoneRepository::class, function () {
            return new PhoneRepository;
        });
    }

    /**
     * @return void
     */
    public function bindServices(): void
    {
        $this->app->bind(IPersonService::class, function () {
            return new PersonService(new PersonRepository, new PhoneRepository);
        });

        $this->app->bind(IUploadedFileService::class, function () {
            return new UploadedFileService(new PersonService(
                new PersonRepository, new PhoneRepository
            ));
        });
    }
}
