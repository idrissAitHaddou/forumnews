<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText($maxNbChars = 40 , $indexSize = 4),
            'body' => $this->faker->text(),
            'slug' => $this->faker->realText($maxNbChars = 40 , $indexSize = 4),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
