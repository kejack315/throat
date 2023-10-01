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
        Schema::create('definition_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('definition_id')->default(0);
            $table->foreignId('rating_id')->default(0);
            $table->foreignId('user_id')->default(0);
            $table->dateTime('published_at')->nullable()->default(null);
            $table->timestamps();
            $table->unsignedTinyInteger('value')->default(0);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definition_rating');
    }
};
