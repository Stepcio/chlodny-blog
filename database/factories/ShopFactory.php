<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Lody '.$this->faker->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.$this->faker->unique()->numberBetween(1, 100000),
            'district' => $this->faker->randomElement(['Śródmieście', 'Mokotów', 'Praga-Południe', 'Wola', 'Żoliborz']),
            'address' => $this->faker->streetAddress(),
            'description' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(3, true),
            'rating' => $this->faker->numberBetween(1, 10) / 2,
            'status' => 'visited',
            'is_featured' => false,
            'visited_at' => $this->faker->dateTimeBetween('-1 year')->format('Y-m-d'),
            'website' => $this->faker->url(),
            'cover_image' => null,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function wantToVisit(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'want_to_visit',
            'body' => null,
            'rating' => null,
            'visited_at' => null,
        ]);
    }
}
