<?php

namespace App\Infrastructure\Factories\Shiporders;

use App\Domain\Shiporders\Entities\Shiporder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShiporderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shiporder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "person_id" => $this->faker->unique()->numberBetween(1, 999999),
        ];
    }
}
