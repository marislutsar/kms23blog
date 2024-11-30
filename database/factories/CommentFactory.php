<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = fake()->dateTimeBetween();
        $updated = fake()->dateTimeBetween($created);
        if(rand(0,9)){
            $updated = $created;
        }
        return [
            'body' => fake()->sentences(3, true),
            'created_at' => $created,
            'updated_at' => $updated,
        ];
    }
}
