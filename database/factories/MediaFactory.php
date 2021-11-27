<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'My file',
            'description' => true,
            'path' => 'file/71ppzqcm0tfHc3zNSRmAFWIFZwT9ExoTZbemRlVe.png'
        ];
    }
}
