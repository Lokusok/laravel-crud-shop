<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_user_carts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');

            $table->string('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_user_carts');
    }
};
