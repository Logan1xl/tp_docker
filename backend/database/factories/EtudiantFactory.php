<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Etudiant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule' => $this->generate_mat(),
            'nom'   => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'sexe' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'login' => $this->faker->unique()->userName(),
            'password' => bcrypt($this->faker->password()),
        ];
    }

    function generate_mat()
    {
        $mat = "IUC" . sprintf("%03d", rand(1, 999));
        if (Etudiant::find($mat) != null) {
            return $this->generate_mat();
        }
        return $mat;
    }
}
