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
        Schema::create('tafsirs', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->foreignId('surah_id')->constrained('surahs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ayah_id')->constrained('ayahs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tafsirs');
    }
};
