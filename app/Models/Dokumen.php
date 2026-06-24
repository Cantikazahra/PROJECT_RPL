<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens';

    protected $fillable = [
        'pengajuan_id',
        'file_ktp',
        'file_sertifikat',
        'file_spt_pbb',
        'file_pernyataan_3in1',
        'file_gambar_bangunan',
        'file_pendukung_opsional'
    ];

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}