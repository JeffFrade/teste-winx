<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborator>
 */
class CollaboratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_company' => 1,
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'position' => $this->faker->jobTitle(),
            'admission_date' => $this->faker->date(),
        ];
    }
}
