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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengajuan')->unique();
            $table->string('nomor_hak_tanah'); // Menampung Nomor Sertifikat / Bukti Tanah
            $table->text('lokasi_tanah');
            $table->integer('luas_tanah');
            $table->integer('tahun_berdiri'); // Untuk hitung denda/potongan retribusi dispensasi
            $table->string('jenis_bangunan');
            $table->text('tujuan_pembangunan');
            $table->string('status')->default('MENUNGGU'); // MENUNGGU, DISETUJUI, DITOLAK
            $table->text('catatan_petugas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
