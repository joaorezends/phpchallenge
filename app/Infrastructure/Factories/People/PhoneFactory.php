<?php

namespace App\Infrastructure\Factories\People;

use App\Domain\People\Entities\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "number" => $this->faker->unique()->numberBetween(1111111, 9999999),
        ];
    }
}
