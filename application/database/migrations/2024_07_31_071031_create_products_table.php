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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index('products_title')->nullable();
            $table->string('slug')->index('products_slug')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('icon')->default('default.png');
            $table->string('image')->default('default.png');
            $table->integer('position')->nullable()->default(0);
            $table->json('advantages')->nullable()->default('[]');
            $table->longText('terms')->nullable();
            $table->longText('pricing')->nullable();
            $table->string('status')->nullable()->default('ACTIVE')->index('products_status');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
