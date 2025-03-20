<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('review_id')->constrained('reviews')->onDelete('NO ACTION');
            $table->enum('type', ['like', 'dislike']);
            $table->timestamps();

            // Ensure a user can only have one reaction per review
            $table->unique(['user_id', 'review_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('review_reactions');
    }
}; 