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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('smoking')->nullable();
            $table->string('alcoholic')->nullable();
            $table->integer('tidiness')->nullable();
            $table->string('prefered_age')->nullable();
            $table->string('routine_type')->nullable();
            $table->string('room_type')->nullable();
            $table->integer('socializing')->nullable();
            $table->integer('cooking_freq')->nullable();
            $table->string('room_temperature')->nullable();
            $table->string('work_type')->nullable();
            $table->integer('noise_tolerance')->nullable();
            $table->string('music_genre')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
