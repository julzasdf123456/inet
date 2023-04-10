<?php

namespace Database\Factories;

use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'StockId' => $this->faker->word,
        'Quantity' => $this->faker->word,
        'UserId' => $this->faker->word,
        'DateStocked' => $this->faker->word,
        'Notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
