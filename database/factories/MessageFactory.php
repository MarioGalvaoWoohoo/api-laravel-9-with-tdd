<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'message' => $this->faker->text(),
            'notify' => $this->faker->boolean(false),
            'type' => 2,
            'priority' => 1,
            'start_date' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'user_id' => 1,
            'status' => 1,
        ];

    }
}
