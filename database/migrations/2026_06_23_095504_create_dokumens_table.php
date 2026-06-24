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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            // Menghubungkan file dokumen ke data pengajuan di atas
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->string('file_ktp');
            $table->string('file_sertifikat');
            $table->string('file_spt_pbb');          // Kolom Baru
            $table->string('file_pernyataan_3in1');  // Kolom Baru
            $table->string('file_gambar_bangunan');
            $table->string('file_pendukung_opsional')->nullable(); // Kolom Baru (Boleh kosong)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
