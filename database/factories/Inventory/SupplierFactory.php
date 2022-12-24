<?php

namespace Database\Factories\Inventory;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name_en' => $name,
            'name_kh' => $name,
            'contact_name' => $this->faker->name(),
            'contact_number' => $this->faker->regexify('0[0-9]{11}'),
            'category_id' => $this->faker->numberBetween(1,9),
            'type_id' => 1,
            'payment_info' => '',
            'user_id' => 1,
            'status' => 1,
        ];
    }
}
