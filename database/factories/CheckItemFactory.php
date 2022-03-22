<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CheckItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker,
            'detail' => $this->faker,
            'event_id' => 1,
        ];
    }
}
