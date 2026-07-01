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
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->string('file_ktp')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->string('file_spt_pbb')->nullable();
            $table->string('file_pernyataan_3in1')->nullable(); 
            $table->string('file_gambar_bangunan')->nullable();
            $table->string('file_pendukung_opsional')->nullable(); 
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
