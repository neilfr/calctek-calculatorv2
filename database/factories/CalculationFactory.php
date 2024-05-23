<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CalculationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $operand1 = $this->faker->numberBetween(1,10);
        $operand2 = $this->faker->numberBetween(1,10);
        $result = $operand1 + $operand2;
        return [
            'calculation' => "{$operand1} + {$operand2}",
            'result' => "{$result}",
        ];
    }
}
