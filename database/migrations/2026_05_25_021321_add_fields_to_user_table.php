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
        Schema::table('users', function (Blueprint $table) {
            // Add extra fields to user database
            $table->string('name')->nullable()->change();
            $table->string('username', 60)->unique()->after('name');
            $table->enum('role', ['admin', 'user'])->default('user')->after('password');
            $table->boolean('is_active')->default(true)->after('role');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Abiility to drop fields from user table
            $table->dropColumn(['username', 'role', 'is_active', 'last_login_at']);
        });
    }
};
