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
        //
        Schema::table('definitions', function (Blueprint $table) {
            $table->foreignId('word_type_id')
                ->after('word_id')
                ->default(1);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('definitions', function (Blueprint $table) {
            $table->dropColumn(['word_type_id']);
        });
    }
};
