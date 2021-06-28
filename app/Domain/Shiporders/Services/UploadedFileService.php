<?php

namespace App\Domain\Shiporders\Services;

use App\Domain\Shiporders\Interfaces\Services\ShiporderService;
use App\Domain\Shiporders\Interfaces\Services\UploadedFileService as IUploadedFileService;
use App\Domain\Shiporders\Jobs\StoreShiporderJob;
use App\Support\Xml;
use Exception;

class UploadedFileService implements IUploadedFileService
{
    /**
     * @return void
     */
    public function __construct(ShiporderService $shiporderService)
    {
        $this->shiporderService = $shiporderService;
    }

    /**
     * @param  string $contents
     * @return bool
     */
    public function validate(string $contents): bool
    {
        try {
            $shiporders = $this->parse($contents);

            foreach ($shiporders as $shiporder) {
                if (! $this->shiporderService->validate($shiporder)) {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param  string $contents
     * @return void
     */
    public function store($contents): void
    {
        if ($this->validate($contents)) {
            $shiporders = $this->parse($contents);
            
            foreach ($shiporders as $shiporder) {
                StoreShiporderJob::dispatch($shiporder);
            }
        }
    }

    /**
     * @param  string $contents
     * @return array
     */
    private function parse($contents): array
    {
        $xml = simplexml_load_string($contents);
        $shiporders = (new Xml($xml))->toArray();
        $shiporders = $shiporders["shiporder"];

        $shiporders = array_map(function ($shiporder) {
            $return = [
                "id" => $shiporder["orderid"],
                "person_id" => $shiporder["orderperson"],
                "shipto" => $shiporder["shipto"]
            ];

            $items = $shiporder["items"]["item"];
            $return["items"] = array_key_exists("title", $items) ? [ $items ] : $items;

            return $return;
        }, $shiporders);

        return $shiporders;
    }
}
