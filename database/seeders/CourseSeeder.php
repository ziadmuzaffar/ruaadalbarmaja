<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $courses = [
            [
                'image' => 'HTML.png',
                'name' => 'HTML',
                'ordering' => 1,
                'track_id' => 1
            ],
            [
                'image' => 'CSS.png',
                'name' => 'CSS',
                'ordering' => 2,
                'track_id' => 1
            ],
            [
                'image' => 'Examples And Applications In CSS.png',
                'name' => 'Examples And Applications In CSS',
                'ordering' => 3,
                'track_id' => 1
            ],
            [
                'image' => 'PHP.png',
                'name' => 'PHP',
                'ordering' => 1,
                'track_id' => 2
            ],
        ];

        foreach ($courses as $item) {
            Course::create($item);
        }
    }
}
