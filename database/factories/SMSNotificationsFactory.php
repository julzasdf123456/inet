<?php

namespace Database\Factories;

use App\Models\SMSNotifications;
use Illuminate\Database\Eloquent\Factories\Factory;

class SMSNotificationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SMSNotifications::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ContactNumber' => $this->faker->word,
        'Message' => $this->faker->word,
        'CustomerId' => $this->faker->word,
        'Billing Month' => $this->faker->word,
        'Type' => $this->faker->word,
        'Status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
