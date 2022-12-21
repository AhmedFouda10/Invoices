<?php

namespace Database\Factories;

use App\Models\sections;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class productsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "Product_name"=>['en'=>$this->faker->name(),'ar'=>$this->faker->name()],
            "description"=>['en'=>$this->faker->sentence(2),'ar'=>$this->faker->sentence(2)],
            "section_id"=>sections::inRandomOrder()->first(),
        ];
    }
}
