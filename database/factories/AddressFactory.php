<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'complement' => $this->faker->secondaryAddress,
            'neighborhood' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip_code' => $this->faker->postcode,
            'user_id' => User::factory(),
        ];
    }
}
