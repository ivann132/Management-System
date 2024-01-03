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
        Schema::create('k_k_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->integer('semester');
            $table->string('no_sk');
            $table->string('nama_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_k_n_s');
    }
};