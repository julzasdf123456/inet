<?php

namespace Database\Factories;

use App\Models\PaymentTransactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentTransactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentTransactions::class;

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
        'PaymentFor' => $this->faker->word,
        'BillingMonth' => $this->faker->word,
        'ORNumber' => $this->faker->word,
        'PaymentDate' => $this->faker->date('Y-m-d H:i:s'),
        'AmountPaid' => $this->faker->word,
        'PaymentType' => $this->faker->word,
        'Trash' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
