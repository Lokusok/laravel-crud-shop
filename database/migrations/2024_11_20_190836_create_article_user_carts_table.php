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
            $table->foreignId('user_id')->nullable()->index()->constrained('users');
            $table->foreignId('session_id')->nullable()->index()->constrained('sessions')->onDelete('SET NULL');
            $table->foreignId('article_id')->index()->constrained('articles');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_user_carts');
    }
};
