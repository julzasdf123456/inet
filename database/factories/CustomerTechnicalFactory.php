<?php

namespace Database\Factories;

use App\Models\CustomerTechnical;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerTechnicalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerTechnical::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'CustomerId' => $this->faker->word,
        'SpeedSubscribed' => $this->faker->word,
        'MonthlyPayment' => $this->faker->word,
        'MacAddress' => $this->faker->word,
        'ModemId' => $this->faker->word,
        'ModemBrand' => $this->faker->word,
        'ModemNumber' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
