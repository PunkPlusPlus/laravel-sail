<?php

namespace Database\Factories;

use App\Models\Cource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cource>
 */
class CourceFactory extends Factory
{

    protected $model = Cource::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(100),
            'price' => fake()->randomNumber(),
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.dreamstime.com%2Fillustration%2Ftraining-cource.html&psig=AOvVaw2FNrp_PBXQbPxckj2etLrn&ust=1700461322037000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJiolZq2z4IDFQAAAAAdAAAAABAE'
        ];
    }
}
