<?php

namespace App\Infrastructure\Repositories\Shiporders;

use App\Domain\Shiporders\Entities\Shiporder;
use App\Domain\Shiporders\Interfaces\Repositories\ShiporderRepository as IShiporderRepository;
use App\Infrastructure\Repositories\Repository;

class ShiporderRepository extends Repository implements IShiporderRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Shiporder::class;
    }
}
