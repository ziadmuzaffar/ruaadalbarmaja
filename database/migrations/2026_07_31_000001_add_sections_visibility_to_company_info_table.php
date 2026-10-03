<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->boolean('show_hero_section')->default(true)->after('is_active');
            $table->boolean('show_about_section')->default(true)->after('show_hero_section');
            $table->boolean('show_services_section')->default(true)->after('show_about_section');
            $table->boolean('show_statistics_section')->default(true)->after('show_services_section');
            $table->boolean('show_projects_section')->default(true)->after('show_statistics_section');
            $table->boolean('show_testimonials_section')->default(true)->after('show_projects_section');
            $table->boolean('show_partners_section')->default(true)->after('show_testimonials_section');
            $table->boolean('show_contact_section')->default(true)->after('show_partners_section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->dropColumn([
                'show_hero_section',
                'show_about_section',
                'show_services_section',
                'show_statistics_section',
                'show_projects_section',
                'show_testimonials_section',
                'show_partners_section',
                'show_contact_section',
            ]);
        });
    }
};
