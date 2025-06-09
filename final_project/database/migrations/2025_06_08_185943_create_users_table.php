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
        Schema::create('laravel_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 100);
            $table->string('user_name', 50)->unique(); // Add UNIQUE constraint
            $table->string('email', 100);
            $table->string('phone', 15);
            $table->string('whatsapp', 15);
            $table->string('country', 50);
            $table->string('city', 50);
            $table->string('password', 255)->comment('hashed');
            $table->string('user_image', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laravel_users');
    }
};
