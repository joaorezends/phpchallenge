<?php

namespace App\Domain\Shiporders;

use App\Domain\Shiporders\Interfaces\Repositories\ShiporderRepository as IShiporderRepository;
use App\Domain\Shiporders\Interfaces\Repositories\ItemRepository as IItemRepository;
use App\Domain\Shiporders\Interfaces\Repositories\ShiptoRepository as IShiptoRepository;
use App\Domain\Shiporders\Interfaces\Services\ShiporderService as IShiporderService;
use App\Domain\Shiporders\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Domain\Shiporders\Services\ShiporderService;
use App\Domain\Shiporders\Services\UploadedFileService;
use App\Infrastructure\Repositories\Shiporders\ShiporderRepository;
use App\Infrastructure\Repositories\Shiporders\ItemRepository;
use App\Infrastructure\Repositories\Shiporders\ShiptoRepository;
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
        $this->app->bind(IShiporderRepository::class, function () {
            return new ShiporderRepository;
        });

        $this->app->bind(IShiptoRepository::class, function () {
            return new ShiptoRepository;
        });

        $this->app->bind(IItemRepository::class, function () {
            return new ItemRepository;
        });
    }

    /**
     * @return void
     */
    public function bindServices(): void
    {
        $this->app->bind(IShiporderService::class, function () {
            return new ShiporderService;
        });

        $this->app->bind(IUploadedFileService::class, function () {
            return new UploadedFileService;
        });
    }
}
