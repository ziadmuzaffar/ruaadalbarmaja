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
            $table->boolean('is_maintenance')->default(false)->after('is_active');
            $table->string('maintenance_title')->nullable()->after('is_maintenance');
            $table->text('maintenance_message')->nullable()->after('maintenance_title');
            $table->timestamp('maintenance_ends_at')->nullable()->after('maintenance_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->dropColumn([
                'is_maintenance',
                'maintenance_title',
                'maintenance_message',
                'maintenance_ends_at',
            ]);
        });
    }
};
