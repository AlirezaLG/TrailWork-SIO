<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Tma;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a test user
        User::factory()->create([
            'id' => 1,
            'name' => 'alireza22',
            'email' => 'test@example.com',
            'password' => bcrypt('alireza22')
        ]);

        // Seed projects
        Project::factory(5)->create();

        // Seed time management logs
        Tma::factory()->createMany([
            [
                'id' => 1,
                'user_id' => 1,
                'project_id' => 2,
                'date' => '2024-05-01',
                'start_time' => '08:15',
                'end_time' => '17:00',
                'work_time' => '8 hr, 45 min',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'project_id' => 1,
                'date' => '2024-05-02',
                'start_time' => '09:15',
                'end_time' => '17:00',
                'work_time' => '7 hr, 45 min',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'project_id' => 1,
                'date' => '2024-05-03',
                'start_time' => '10:15',
                'end_time' => '16:30',
                'work_time' => '5 hr, 15 min',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'project_id' => 3,
                'date' => '2024-05-04',
                'start_time' => '10:15',
                'end_time' => '16:30',
                'work_time' => '5 hr, 15 min',
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'project_id' => 1,
                'date' => '2024-05-05',
                'start_time' => '09:15',
                'end_time' => '17:00',
                'work_time' => '7 hr, 45 min',
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'project_id' => 2,
                'date' => '2024-05-06',
                'start_time' => '09:15',
                'end_time' => '16:00',
                'work_time' => '6 hr, 45 min',
            ],
        ]);
    }
}
