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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik')->unique(); // dipakai untuk login voting
            $table->string('nama');
            $table->enum('role', ['siswa', 'guru', 'pegawai']);
            $table->string('kelas')->nullable(); // khusus siswa
            $table->boolean('sudah_vote')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
