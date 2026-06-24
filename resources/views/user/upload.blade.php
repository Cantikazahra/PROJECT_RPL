<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen - Perizinan Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen p-2 overflow-hidden">

    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-y-auto relative p-5 pt-10 flex flex-col justify-between no-scrollbar">
        
        <div class="w-full flex-grow flex flex-col">
            <div class="flex justify-between items-center mb-5">
                <a href="{{ route('user.pengajuan.detail', $pengajuan_id) }}" class="w-7 h-7 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <h2 class="text-sm font-bold text-gray-800 tracking-wide">Upload Dokumen</h2>
                <div class="w-7"></div>
            </div>

            <div class="text-left mb-4 px-1">
                <h3 class="text-xs font-bold text-gray-800 mb-0.5">Upload Dokumen Persyaratan</h3>
                <p class="text-[9px] text-gray-400">Upload semua dokumen yang diperlukan</p>
            </div>

<form action="{{ route('user.upload.process', $pengajuan_id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 flex-grow text-left overflow-y-auto no-scrollbar max-h-[440px] pr-0.5">
                @csrf

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <label class="block text-[11px] font-bold text-gray-800">KTP Pemohon</label>
                    <span class="block text-[9px] text-gray-400 mb-2">Upload KTP Anda</span>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition">
                        <input type="file" id="input_ktp" name="file_ktp" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg mb-1"></i>
                        <p id="text_ktp" class="text-[9px] text-gray-500 font-medium">Klik untuk upload</p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <label class="block text-[11px] font-bold text-gray-800">Bukti Kepemilikan Tanah</label>
                    <span class="block text-[9px] text-gray-400 mb-2">Sertipikat / Kekancingan / Letter C</span>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition">
                        <input type="file" id="input_sertifikat" name="file_sertifikat" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg mb-1"></i>
                        <p id="text_sertifikat" class="text-[9px] text-gray-500 font-medium">Klik untuk upload</p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <label class="block text-[11px] font-bold text-gray-800">Fotokopi SPT PBB</label>
                    <span class="block text-[9px] text-gray-400 mb-2">Pajak bumi dan bangunan tahun berjalan</span>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition">
                        <input type="file" id="input_spt_pbb" name="file_spt_pbb" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg mb-1"></i>
                        <p id="text_spt_pbb" class="text-[9px] text-gray-500 font-medium">Klik untuk upload</p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <div class="flex justify-between items-start mb-1">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-800">Surat Pernyataan (3-in-1 & Pendirian)</label>
                            <span class="block text-[8.5px] text-gray-400">Unduh template, isi, lalu upload di bawah</span>
                        </div>
                        <a href="{{ asset('templates/format_surat_dispensasi_imb.docx') }}" download class="px-2 py-1 bg-blue-600 text-white font-bold rounded-lg text-[8px] hover:bg-blue-700 transition flex items-center space-x-1 focus:outline-none shrink-0">
                            <i class="fas fa-download text-[7px]"></i>
                            <span>UNDUH (.DOCX)</span>
                        </a>
                    </div>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition mt-2">
                        <input type="file" id="input_pernyataan" name="file_pernyataan_3in1" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg mb-1"></i>
                        <p id="text_pernyataan" class="text-[9px] text-gray-500 font-medium">Klik untuk upload surat bertanda tangan</p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <label class="block text-[11px] font-bold text-gray-800">Gambar Teknis & Foto 3R</label>
                    <span class="block text-[9px] text-gray-400 mb-2">Denah, lokasi, dan foto tampak depan</span>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition">
                        <input type="file" id="input_gambar" name="file_gambar_bangunan" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg mb-1"></i>
                        <p id="text_gambar" class="text-[9px] text-gray-500 font-medium">Klik untuk upload</p>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs">
                    <label class="block text-[11px] font-bold text-gray-500">Berkas Khusus / Pendukung (Opsional)</label>
                    <span class="block text-[9px] text-gray-400 mb-2">KK Miskin / Surat Sewa / Perhitungan Struktur</span>
                    <div class="border border-dashed border-gray-300 rounded-xl p-4 text-center bg-gray-50 relative cursor-pointer hover:bg-gray-100 transition">
                        <input type="file" id="input_opsional" name="file_pendukung_opsional" class="absolute inset-0 opacity-0 cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-lg mb-1"></i>
                        <p id="text_opsional" class="text-[9px] text-gray-400 font-medium">Klik untuk upload (Jika ada)</p>
                    </div>
                </div>

                <div class="space-y-2 pt-2 sticky bottom-0 bg-white z-10">
                    <button type="submit" class="w-full py-3 bg-[#2A65EA] text-white font-bold rounded-xl text-xs hover:bg-blue-700 transition tracking-wide shadow-md">
                        SIMPAN DOKUMEN
                    </button>
                    <a href="{{ route('user.dashboard') }}" class="block w-full text-center py-2.5 border border-gray-300 text-gray-500 font-semibold rounded-xl text-[10px] hover:bg-gray-50 transition tracking-wide">
                        UNGGAH BERKAS NANTI
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>
</html>