<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tma>
 */
class TmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'project_id' => 2,
            'date' => '2024-05-01',
            'start_time' => '08:15',
            'end_time' => '17:00',
            'work_time' => '8 hr, 45 min',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
