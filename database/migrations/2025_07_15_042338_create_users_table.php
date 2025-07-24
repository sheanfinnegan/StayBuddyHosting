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
            $table->id();
            $table->string('name');
            $table->text('desc')->nullable()->default('Describe Yourself to Buddies');
            $table->string('email')->unique();
            $table->string('phone_num');
            $table->date('bod');
            $table->string('gender');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('occupation');
            $table->unsignedBigInteger('wlid')->nullable();
            $table->string('profile_picture');
            $table->float('rating', 2)->default(rand(3,5));
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('wlid')
                ->references('wlid')
                ->on('waiting_lists')
                ->onDelete('set null');
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
