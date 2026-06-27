<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';

    protected $fillable = [
        'no_pengajuan', 
        'user_id', 
        'nomor_hak_tanah', 
        'lokasi_tanah', 
        'luas_tanah', 
        'tahun_pembangunan', 
        'jenis_bangunan', 
        'tujuan_pembangunan', 
        'status', 
        'catatan_petugas', 
        'tanggal_pengajuan'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');    }

    public function dokumen() {
        return $this->hasOne(Dokumen::class, 'pengajuan_id');
    }

    public function scopeMenunggu($query) {
        return $query->where('status', 'menunggu');
    }
}