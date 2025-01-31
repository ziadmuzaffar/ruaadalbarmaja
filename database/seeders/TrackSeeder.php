<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class TrackSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $tracks = [
            [
                'icon' => 'magic',
                'name' => 'Front-End Developer'
            ],
            [
                'icon' => 'earth',
                'name' => 'Back-End Developer'
            ],
        ];
    
        foreach ($tracks as $item) {
            Track::create($item);
        }
    }
}
