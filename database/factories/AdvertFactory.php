<?php

namespace Database\Factories;

use App\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(rand(3, 5)),
            'description' => implode(". ", $this->faker->paragraphs(rand(6, 14))),
            'image_patch' => $this->faker->image('public/images', 400, 300),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null)
        ];
    }
}
