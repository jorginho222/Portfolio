<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $colorName = $this
            ->faker
            ->randomElement(Skill::getAvailableTextColors());

        $iconName = $this
            ->faker
            ->randomElement(Skill::getAvailableIcons());

        return [
            'name' => $this->faker->unique()->word(1, true),
            // 'description' => $this->faker->sentence(),
            'color' => $colorName,
            'icon_name' => $iconName,
        ];
    }
}
