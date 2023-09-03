<?php

namespace Database\Factories;

use App\Models\TicketTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TicketTypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'TicketName' => $this->faker->word,
        'Notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
