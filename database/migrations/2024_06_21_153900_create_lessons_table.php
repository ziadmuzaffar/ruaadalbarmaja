<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->text('ordering');
            $table->text('name');
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->text('url')->unique();
            $table->timestamps();
        });
    }
    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
