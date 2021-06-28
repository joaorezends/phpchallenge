<?php

namespace App\Infrastructure\Repositories\Shiporders;

use App\Domain\Shiporders\Entities\Shipto;
use App\Domain\Shiporders\Interfaces\Repositories\ShiptoRepository as IShiptoRepository;
use App\Infrastructure\Repositories\Repository;

class ShiptoRepository extends Repository implements IShiptoRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Shipto::class;
    }

    /**
     * @param  array $attributes
     * @return Shipto
     */
    public function store(array $attributes): Shipto
    {
        return $this->model->updateOrCreate(["shiporder_id" => $attributes["shiporder_id"]], $attributes);
    }
}
