<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
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
            'name_kh' => $name,
            'name_en' => $name,
            'id_card_no' => $this->faker->regexify('[0-9]{9}'),
            'gender_id' => $this->faker->numberBetween(1,2),
            'email' => $this->faker->email(),
            'phone' => $this->faker->regexify('0[0-9]{11}'),
            'date_of_birth' => null,
            'age' => null,
            'education' => null,
            'position' => null,
            'nationality_id' => null,
            'marital_status_id' => null,
            'enterprise_id' => null,
            'blood_type_id' => null,
            'photo' => null,
            'father_name' => null,
            'father_position' => null,
            'mother_name' => null,
            'mother_position' => null,
            'house_no' => null,
            'street_no' => null,
            'postal_code' => null,
            'registered_at' => $this->faker->dateTimeBetween('-10 days', '-1 day'),
            'address_id' => null,
            'user_id' => 1,
            
        ];
    }
}
