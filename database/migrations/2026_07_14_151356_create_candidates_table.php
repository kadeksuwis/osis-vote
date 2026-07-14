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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('no_urut'); // nomor urut kandidat
            $table->string('nama_ketua');
            $table->string('nama_wakil')->nullable();
            $table->string('foto')->nullable(); // path foto
            $table->text('visi');
            $table->text('misi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
