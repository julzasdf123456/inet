<?php

namespace Database\Factories;

use App\Models\Tickets;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tickets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'CustomerId' => $this->faker->word,
        'CustomerName' => $this->faker->word,
        'Town' => $this->faker->word,
        'Barangay' => $this->faker->word,
        'Ticket' => $this->faker->word,
        'Details' => $this->faker->word,
        'Notes' => $this->faker->word,
        'Status' => $this->faker->word,
        'Latitude' => $this->faker->word,
        'Longitude' => $this->faker->word,
        'ExecutedBy' => $this->faker->word,
        'UserId' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
