<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     * php artisan tinker
     * Song::factory()->count(5)->create()
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'genre_id' => rand(1, 25),
            'name' => $this->faker->unique()->word,
            'length' => (rand(1,8) . ":" . rand(10, 60)),
            'artist' => $this->faker->name() . ' ' . $this->faker->lastName(),
            'cover_art' => $this->faker->imageUrl(),
            'date_created' => $this->faker->date(),
            'date_added' => Carbon::now()
        ];
    }
}
