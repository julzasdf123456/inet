<?php

namespace Database\Factories;

use App\Models\Stocks;
use Illuminate\Database\Eloquent\Factories\Factory;

class StocksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stocks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'StockName' => $this->faker->word,
        'Description' => $this->faker->word,
        'Type' => $this->faker->word,
        'CanBeChargedToCustomer' => $this->faker->word,
        'RetailPrice' => $this->faker->word,
        'Unit' => $this->faker->word,
        'StockQuantity' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
