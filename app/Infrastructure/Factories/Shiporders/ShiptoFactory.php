<?php

namespace App\Infrastructure\Factories\Shiporders;

use App\Domain\Shiporders\Entities\Shipto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiptoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
            "city" => $this->faker->city(),
            "country" => $this->faker->country(),
        ];
    }
}
