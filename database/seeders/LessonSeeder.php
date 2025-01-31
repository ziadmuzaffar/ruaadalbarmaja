<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            if ($i == 1) {
                $status = 1;
            } else {
                $status = 0;
            }
            Lesson::create([
                'course_id' => '1',
                'video' => '1.mp4',
                'order' => $i,
                'lesson' => 'Introduction and What I Need To Learn',
                'time' => '01:00',
                'status' => $status
            ]);
        }
    }
}
