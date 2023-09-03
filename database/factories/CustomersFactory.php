<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'FullName' => $this->faker->word,
        'Town' => $this->faker->word,
        'Barangay' => $this->faker->word,
        'Purok' => $this->faker->word,
        'ContactNumber' => $this->faker->word,
        'Email' => $this->faker->word,
        'CustomerTechnicalId' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
