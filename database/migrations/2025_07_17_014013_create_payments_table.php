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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('wlid')->nullable(); // foreign key ke waiting_list
            $table->float('price');
            $table->time('deadline');
            $table->boolean('paid')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('wlid')->references('wlid')->on('waiting_lists')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
