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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index('users_id');
            $table->string('name')->index('users_name')->nullable();
            $table->string('username')->index('users_username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('email')->index('users_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->index('users_role')->default('ADMIN')->nullable();
            $table->string('phone')->index('users_phone')->nullable();
            $table->string('photo')->default('users/default.png');
            $table->integer('deleted')->default(0)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
