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
        Schema::create('home_details', function (Blueprint $table) {
            $table->id();
            $table->string('fsq_id')->unique();
            $table->string('name')->nullable();
            $table->float('rating');
            $table->integer('price');
            $table->string('duration');
            $table->string('contact');
            $table->integer('area');
            $table->integer('bedroom');
            $table->integer('air_conditioning');
            $table->integer('bathroom');
            $table->integer('kitchen');
            $table->integer('max_pax');
            $table->integer('hot_water');
            $table->integer('refrigerator');
            $table->integer('wifi');
            $table->integer('tv');
            $table->string('main_images');
            $table->json('photos');
            $table->json('reviews')->nullable(); 
            $table->text('alamat');
            
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_details');
    }
};
