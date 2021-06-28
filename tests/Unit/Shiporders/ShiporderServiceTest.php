<?php

namespace Tests\Unit\Shiporders;

use App\Domain\Shiporders\Entities\Item;
use App\Domain\Shiporders\Entities\Shiporder;
use App\Domain\Shiporders\Entities\Shipto;
use App\Domain\Shiporders\Services\ShiporderService;
use App\Infrastructure\Repositories\Shiporders\ItemRepository;
use App\Infrastructure\Repositories\Shiporders\ShiporderRepository;
use App\Infrastructure\Repositories\Shiporders\ShiptoRepository;
use Tests\TestCase;
use Illuminate\Support\Str;

class ShiporderServiceTest extends TestCase
{
    /** @test */
    public function it_should_store_in_database()
    {
        $attributes = $this->getShiporder();
        $shiporder = $this->getService()->store($attributes);

        $this->assertInstanceOf(Shiporder::class, $shiporder);
        $this->assertDatabaseHas("shiporders", ["id" => $shiporder->id, "person_id" => $shiporder->person_id]);

        $this->assertDatabaseHas("shiporders_shiptos", [
            "name" => $shiporder->shipto->name,
            "address" => $shiporder->shipto->address,
            "city" => $shiporder->shipto->city,
            "country" => $shiporder->shipto->country,
            "shiporder_id" => $shiporder->id
        ]);

        $this->assertEquals(2, $shiporder->items->count());

        foreach ($shiporder->items as $item) {
            $this->assertDatabaseHas("shiporders_items", [
                "title" => $item->title,
                "note" => $item->note,
                "quantity" => $item->quantity,
                "price" => $item->price,
                "shiporder_id" => $shiporder->id
            ]);
        }
    }

    /** @test */
    public function person_id_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["person_id"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function person_id_field_is_integer()
    {
        $attributes = $this->getShiporder();
        $attributes["person_id"] = "string";
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function person_id_field_min_1()
    {
        $attributes = $this->getShiporder();
        $attributes["person_id"] = -1;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function shipto_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function shipto_name_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["name"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function shipto_name_field_max_191()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["name"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function shipto_address_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["address"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function shipto_address_field_max_191()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["address"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function shipto_city_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["city"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function shipto_city_field_max_191()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["city"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function shipto_country_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["country"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function shipto_country_field_max_191()
    {
        $attributes = $this->getShiporder();
        $attributes["shipto"]["country"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function items_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["items"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function item_title_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["title"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function item_title_field_max_191()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["title"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function item_note_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["note"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function item_quantity_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["quantity"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    /** @test */
    public function item_quantity_field_is_integer()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["quantity"] = "string";
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function item_quantity_field_min_1()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["quantity"] = -1;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function item_price_field_is_required()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["price"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function item_price_field_is_numeric()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["price"] = "string";
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function item_price_field_min_001()
    {
        $attributes = $this->getShiporder();
        $attributes["items"][0]["price"] = 0.00;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }
    
    /** @return ShiporderService */
    private function getService(): ShiporderService
    {
        return new ShiporderService(new ShiporderRepository, new ShiptoRepository, new ItemRepository);
    }

    /** @return array */
    private function getShiporder(): array
    {
        $shiporder = Shiporder::factory()->make()->toArray();
        $shiporder["shipto"] = Shipto::factory()->make()->toArray();
        $shiporder["items"] = Item::factory()->count(2)->make()->toArray();

        return $shiporder;
    }
}
