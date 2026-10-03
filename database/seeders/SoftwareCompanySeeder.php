<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SoftwareCompanySeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanyInfoSeeder::class,
            // ServiceSeeder::class,
            // CategorySeeder::class,
            // ProjectSeeder::class,
            // StatisticSeeder::class,
            // TestimonialSeeder::class,
            // PartnerSeeder::class,
        ]);
    }
}
