<?php

namespace Database\Factories;

use App\Models\sections;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sections>
 */
class sectionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "section_name"=>['en'=>$this->faker->name(),'ar'=>$this->faker->name()],
            "description"=>['en'=>$this->faker->sentence(2),'ar'=>$this->faker->sentence(2)],
            "Created_by"=>"ahmed",
        ];
    }
}
