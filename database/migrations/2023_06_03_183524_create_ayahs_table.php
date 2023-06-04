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
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->bigInteger('juz');
            $table->bigInteger('manzil');
            $table->bigInteger('page');
            $table->bigInteger('ruku');
            $table->bigInteger('hizbQuarter');
            $table->bigInteger('number_in_surah');
            $table->boolean('sajda');
            $table->foreignId('surah_id')->constrained('surahs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayahs');
    }
};
