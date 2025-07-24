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
        Schema::create('waiting_lists', function (Blueprint $table) {
            $table->id('wlid'); // ini akan jadi PRIMARY KEY dan AUTO_INCREMENT
            $table->string('homestay_id');
            $table->timestamp('created')->useCurrent();
            $table->timestamp('remaining_time')->nullable();
            $table->boolean('done')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_lists');
    }
};
