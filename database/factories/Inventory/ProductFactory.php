<?php

namespace Database\Factories\Inventory;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $cost = $this->faker->numberBetween(1,50);
        return [
            'code' => generate_code('PR', 'products'),
            'name_en' => $name,
            'name_kh' => $name,
            'cost' => $cost,
            'price' => $cost + $this->faker->numberBetween(1, (($cost < 15)? 3 : 15)),
            'qty_alert' => $this->faker->randomElement([10, 15, 20, 30, 50]),
            'category_id' => $this->faker->numberBetween(1,9),
            'unit_id' => $this->faker->numberBetween(1,11),
            'type_id' => 1,
            'user_id' => 1,
            'status' => 1,
        ];
    }
}
