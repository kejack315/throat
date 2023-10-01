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
        Schema::create('definitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->default(0);
            $table->text('definition');
            $table->foreignId('user_id')->default(0);
            $table->boolean('appropriate')->default(false);
            $table->dateTime('published_at')->nullable()->default(null);
            $table->string('user_name')->nullable();
            $table->unsignedTinyInteger('stars')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('definitions');
    }
};
