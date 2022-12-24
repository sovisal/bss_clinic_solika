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
        $name = $this->name();
        return [
            'name_en' => $name,
            'name_kh' => $name,
            'contact_name' => $this->name(),
            'contact_number' => $this->faker->regexify('0[0-9]{11}'),
            'category_id' => $this->faker->numberBetween(1,3),
            'type_id' => $this->faker->numberBetween(1,3),
            'user_id' => 1,
            'status' => 1,
            'payment_info' => '',
        ];
    }
}
