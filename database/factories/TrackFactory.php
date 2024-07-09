<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->sentence(3),
            'artist' => $this->faker->name(),
            'cover' => $this->faker->imageUrl(),
            'file' => $this->faker->imageUrl(),
            'album' => $this->faker->name(),
            'genre' => $this->faker->word(),
            'display' => $this->faker->boolean(),
            'playCount' => $this->faker->randomNumber(),
        ];
    }
}
