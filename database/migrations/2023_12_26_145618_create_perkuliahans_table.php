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
        Schema::create('perkuliahans', function (Blueprint $table) {
            $table->id();
            $table->string('mata_Kuliah');
            $table->integer('semester');
            $table->integer('sks');
            $table->string('no_sk');
            $table->string('nama_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkuliahans');
    }
};
