<?php

namespace Database\Factories;

use App\Models\Billings;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'BillNumber' => $this->faker->word,
        'CustomerId' => $this->faker->word,
        'BillingMonth' => $this->faker->word,
        'BillingDate' => $this->faker->word,
        'DueDate' => $this->faker->word,
        'BillAmountDue' => $this->faker->word,
        'AdditionalPayments' => $this->faker->word,
        'Deductions' => $this->faker->word,
        'TotalAmountDue' => $this->faker->word,
        'PaidAmount' => $this->faker->word,
        'Balance' => $this->faker->word,
        'Notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
