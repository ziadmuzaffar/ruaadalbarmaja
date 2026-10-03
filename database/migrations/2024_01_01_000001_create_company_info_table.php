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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('about');
            $table->string('logo')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('address');
            $table->string('city')->default('الرياض');
            $table->string('district')->default('السلي');
            $table->string('street')->nullable();
            $table->year('founded_year')->default(1990);
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
