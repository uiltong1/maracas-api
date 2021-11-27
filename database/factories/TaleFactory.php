<?php

namespace Database\Factories;

use App\Models\Tale;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tale::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'is_enable' =>true,
            'body' =>  'My new text',
        ];
    }
}
