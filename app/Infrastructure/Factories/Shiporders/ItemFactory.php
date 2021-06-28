<?php

namespace App\Infrastructure\Factories\Shiporders;

use App\Domain\Shiporders\Entities\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->name(),
            "note" => $this->faker->text(),
            "quantity" => $this->faker->unique()->numberBetween(1, 999),
            "price" => $this->faker->randomFloat(2, 1, 999),
        ];
    }
}
