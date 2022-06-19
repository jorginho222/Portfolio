<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'title' => $this->faker->unique()->word(2, true),
            'description' => $this->faker->sentence(),
            'link' => $this->faker->url(),
            'logo_path' => 'storage/project-logos/logo_indigo.png',
        ];
    }
}
