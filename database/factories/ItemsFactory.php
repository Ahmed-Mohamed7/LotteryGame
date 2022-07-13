<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Name' => $this->faker->name(),
            'Image'=>$this->faker->imageUrl(),
            'Description'=>Str::random(40),
            'Price'=>$this->faker->randomFloat(5,0.000001,1),
        ];
    }
}
