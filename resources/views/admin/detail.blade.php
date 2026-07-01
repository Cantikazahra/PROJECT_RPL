@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.pengajuan') }}" class="bg-white p-2 rounded-lg border shadow-sm hover:bg-gray-50 text-gray-600">
            ← Kembali
        </a>
        <h2 class="text-xl font-black text-gray-800">Detail Pengajuan #{{ $pengajuan->no_pengajuan }}</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 border rounded-2xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-6 border-b pb-4">Informasi Permohonan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <p class="text-gray-500">Nama Pemohon: <span class="text-gray-900 font-semibold block">{{ $pengajuan->user->nama ?? '-' }}</span></p>
                    <p class="text-gray-500">Jenis Bangunan: <span class="text-gray-900 font-semibold block">{{ $pengajuan->jenis_bangunan }}</span></p>
                    <p class="text-gray-500">Lokasi: <span class="text-gray-900 font-semibold block">{{ $pengajuan->lokasi_tanah }}</span></p>
                    <p class="text-gray-500">Luas Tanah: <span class="text-gray-900 font-semibold block">{{ $pengajuan->luas_tanah }} m²</span></p>
                    <p class="text-gray-500">Tujuan: <span class="text-gray-900 font-semibold block">{{ $pengajuan->tujuan_pembangunan }}</span></p>
                    
                    @php
                        // Standardisasi warna status menggunakan snake_case
                        $statusColor = [
                            'menunggu'        => 'bg-yellow-100 text-yellow-700',
                            'disetujui'       => 'bg-green-100 text-green-700',
                            'ditolak'         => 'bg-red-100 text-red-700',
                            'perlu_perbaikan' => 'bg-orange-100 text-orange-700',
                        ][strtolower($pengajuan->status)] ?? 'bg-gray-100 text-gray-600';
                    @endphp

                    <p class="text-gray-500">Status Saat Ini: 
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusColor }} block w-max mt-1">
                            {{ str_replace('_', ' ', $pengajuan->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 border rounded-2xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Dokumen Persyaratan</h3>
                <div class="space-y-2">
                    @php
                        $dokumenList = [
                            'KTP Pemohon' => 'file_ktp',
                            'Bukti Kepemilikan Tanah' => 'file_sertifikat',
                            'Fotokopi SPT PBB' => 'file_spt_pbb',
                            'Surat Pernyataan (3-in-1)' => 'file_pernyataan_3in1',
                            'Gambar Denah & Foto 3R' => 'file_gambar_bangunan',
                            'Berkas Khusus (Opsional)' => 'file_pendukung_opsional'
                        ];
                    @endphp

                    @foreach($dokumenList as $label => $key)
                    <div class="flex justify-between items-center py-3 border-b border-gray-50 last:border-0">
                        <span class="text-sm text-gray-700">{{ $label }}</span>
                        @if(isset($pengajuan->dokumen->$key))
                            <a href="{{ route('user.dokumen.lihat', [$pengajuan->id, $key]) }}" target="_blank" 
                               class="bg-gray-100 px-4 py-1.5 rounded-lg text-[10px] font-bold text-gray-600 hover:bg-gray-200 transition uppercase">Lihat</a>
                        @else
                            <span class="text-[10px] text-gray-400 italic">Belum diunggah</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-6 border rounded-2xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Catatan Revisi / Verifikasi</h3>
                <form action="{{ route('admin.updateStatus', $pengajuan->id) }}" method="POST" id="adminForm">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" id="status_input">
                    <textarea name="catatan" class="w-full border rounded-xl p-4 text-sm focus:ring-2 focus:ring-blue-500 outline-none" rows="3" placeholder="Tulis catatan jika ada revisi...">{{ $pengajuan->catatan_petugas }}</textarea>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 border rounded-2xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Verifikasi</h3>
                <div class="space-y-3">
                    <button onclick="submitAdmin('disetujui')" class="w-full bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 transition">Disetujui</button>
                    <button onclick="submitAdmin('ditolak')" class="w-full bg-red-600 text-white font-bold py-3 rounded-xl hover:bg-red-700 transition">Tolak</button>
                    <button onclick="submitAdmin('perlu_perbaikan')" class="w-full bg-orange-500 text-white font-bold py-3 rounded-xl hover:bg-orange-600 transition">Perlu Perbaikan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitAdmin(status) {
        document.getElementById('status_input').value = status;
        document.getElementById('adminForm').submit();
    }
</script>
@endsection