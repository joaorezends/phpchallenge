<?php

namespace App\Presentation\Api\Http;

use App\Domain\Shiporders\Interfaces\Services\ShiporderService;

class ShipordersController extends Controller
{
    /**
     * @return string
     */
    public function getServiceClass(): string
    {
        return ShiporderService::class;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "shiporders";
    }
}
