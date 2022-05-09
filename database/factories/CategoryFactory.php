<?php

namespace Database\Factories;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text($maxNbChars = 20),
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
