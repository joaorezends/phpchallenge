<?php

namespace App\Presentation\Api\Http;

use App\Domain\Shiporders\Interfaces\Services\ShiporderService;

class ShipordersController extends Controller
{
    /**
     * @param ShiporderService $shiporderService
     */
    public function __construct(ShiporderService $shiporderService)
    {
        parent::__construct($shiporderService);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return "shiporders";
    }
}
