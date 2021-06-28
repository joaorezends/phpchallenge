<?php

namespace Tests\Unit\People;

use App\Domain\People\Entities\Person;
use App\Domain\People\Entities\Phone;
use App\Domain\People\Services\PersonService;
use App\Infrastructure\Repositories\People\PersonRepository;
use App\Infrastructure\Repositories\People\PhoneRepository;
use Tests\TestCase;
use Illuminate\Support\Str;

class PersonServiceTest extends TestCase
{
    /** @test */
    public function it_should_store_in_database()
    {
        $attributes = $this->getPerson();
        $person = $this->getService()->store($attributes);

        $this->assertInstanceOf(Person::class, $person);
        $this->assertDatabaseHas("people", ["name" => $person->name]);
        $this->assertEquals(2, $person->phones->count());

        foreach ($person->phones as $phone) {
            $this->assertDatabaseHas("people_phones", [
                "number" => $phone->number,
                "person_id" => $person->id
            ]);
        }
    }

    /** @test */
    public function id_field_is_integer()
    {
        $isValid = $this->getService()->validate([
            "id" => "string",
            "name" => "Complete Name",
            "phones" => [
                [
                    "number" => 1234567
                ],
            ]
        ]);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function id_field_min_1()
    {
        $isValid = $this->getService()->validate([
            "id" => -1,
            "name" => "Complete Name",
            "phones" => [
                [
                    "number" => 1234567
                ],
            ]
        ]);
        $this->assertFalse($isValid);
    }
    
    /** @test */
    public function name_field_is_required()
    {
        $attributes = $this->getPerson();
        $attributes["name"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function name_field_max_191()
    {
        $attributes = $this->getPerson();
        $attributes["name"] = Str::random(192);
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function phones_is_required()
    {
        $attributes = $this->getPerson();
        $attributes["phones"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function phone_number_field_is_required()
    {
        $attributes = $this->getPerson();
        $attributes["phones"][0]["number"] = null;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @test */
    public function phone_number_field_size_seven()
    {
        $attributes = $this->getPerson();
        $attributes["phones"][0]["number"] = 12345678;
        $isValid = $this->getService()->validate($attributes);
        $this->assertFalse($isValid);
    }

    /** @return PersonService */
    private function getService(): PersonService
    {
        return new PersonService(new PersonRepository, new PhoneRepository);
    }

    /** @return array */
    private function getPerson(): array
    {
        $person = Person::factory()->make()->toArray();
        $person["phones"] = Phone::factory()->count(2)->make()->toArray();

        return $person;
    }
}
