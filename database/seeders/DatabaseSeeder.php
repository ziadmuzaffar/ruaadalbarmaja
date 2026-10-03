<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SoftwareCompanySeeder::class,
            ServiceSeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            StatisticSeeder::class,
            TestimonialSeeder::class,
            PartnerSeeder::class,
        ]);
    }
}
