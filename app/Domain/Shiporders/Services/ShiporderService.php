<?php

namespace App\Domain\Shiporders\Services;

use App\Domain\Abstracts\Service;
use App\Domain\Shiporders\Entities\Shiporder;
use App\Domain\Shiporders\Interfaces\Repositories\ShiporderRepository;
use App\Domain\Shiporders\Interfaces\Repositories\ItemRepository;
use App\Domain\Shiporders\Interfaces\Repositories\ShiptoRepository;
use App\Domain\Shiporders\Interfaces\Services\ShiporderService as IShiporderService;
use Exception;
use Illuminate\Support\Facades\DB;

class ShiporderService extends Service implements IShiporderService
{
    /**
     * @var array
     */
    protected $rules = [
        "id" => "nullable|integer|min:1",
        "person_id" => "required|integer|min:1",
        "shipto" => "required|array|min:1",
        "shipto.name" => "required|max:191",
        "shipto.address" => "required|max:191",
        "shipto.city" => "required|max:191",
        "shipto.country" => "required|max:191",
        "items" => "required|array|min:1",
        "items.*.title" => "required|max:191",
        "items.*.note" => "required",
        "items.*.quantity" => "required|integer|min:1",
        "items.*.price" => "required|numeric|min:0.01",
    ];

    /**
     * @var ShiptoRepository
     */
    private $shiptoRepository;

    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @return void
     */
    public function __construct(ShiporderRepository $shiporderRepository, ShiptoRepository $shiptoRepository, ItemRepository $itemRepository)
    {
        parent::__construct($shiporderRepository);
        $this->shiptoRepository = $shiptoRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @param  array $attributes
     * @return Shiporder
     */
    public function store(array $attributes): Shiporder
    {
        try {
            DB::beginTransaction();

            $shiporder = parent::store($attributes);

            $this->shiptoRepository->store($attributes["shipto"] + ["shiporder_id" => $shiporder->id]);

            foreach ($attributes["items"] as $item) {
                $this->itemRepository->store($item + ["shiporder_id" => $shiporder->id]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $shiporder;
    }
}
