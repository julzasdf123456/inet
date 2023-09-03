<?php

namespace Database\Factories;

use App\Models\Expenses;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expenses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ExpenseDate' => $this->faker->word,
        'ExpenseFor' => $this->faker->word,
        'Amount' => $this->faker->word,
        'UserId' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
