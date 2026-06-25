<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Perizinan - SIM-IMB Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen p-2 overflow-hidden">

    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-y-auto p-5 pt-10 no-scrollbar relative flex flex-col">
        
        @include('layouts.sidebar')

        <div class="flex justify-between items-center mb-6 relative z-10">
            <button onclick="toggleSidebar(true)" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                <i class="fas fa-bars text-xs"></i>
            </button>
            <h2 class="text-sm font-bold text-gray-800">Panduan IMB</h2>
            <div class="w-8"></div>
        </div>

        <div class="flex-grow space-y-4 relative z-0">
            
            <div class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm">
                <h3 class="text-[11px] font-bold text-blue-600 mb-2 uppercase tracking-wide flex items-center">
                    <i class="fas fa-home mr-2"></i> Kriteria Bangunan
                </h3>
                <ul class="text-[10px] text-gray-600 space-y-1.5 list-disc pl-3 leading-relaxed">
                    <li>Rumah tinggal maksimal 2 lantai.</li>
                    <li>Luas bangunan maksimal 300 m².</li>
                    <li>Fungsi ikutan usaha (toko/kantor) maks 50 m².</li>
                    <li>Status tanah pekarangan & sesuai tata ruang.</li>
                    <li>Nilai Jual Pajak Bumi dan Bangunan di bawah Rp 2.000.000/m².</li>
                </ul>
            </div>

            <div class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm">
                <h3 class="text-[11px] font-bold text-blue-600 mb-2 uppercase tracking-wide flex items-center">
                    <i class="fas fa-percent mr-2"></i> Info Dispensasi
                </h3>
                <p class="text-[10px] text-gray-600 leading-relaxed mb-2">
                    Keluarga miskin/rentan dibebaskan dari retribusi.
                </p>
                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <p class="font-bold text-[10px] text-gray-800">S.d 2000</p>
                        <p class="text-[9px] text-gray-500">Diskon 75%</p>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <p class="font-bold text-[10px] text-gray-800">2001-2011</p>
                        <p class="text-[9px] text-gray-500">Diskon 50%</p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm">
                <h3 class="text-[11px] font-bold text-blue-600 mb-2 uppercase tracking-wide flex items-center">
                    <i class="fas fa-clipboard-list mr-2"></i> Prosedur
                </h3>
                <ol class="text-[10px] text-gray-600 space-y-1.5 list-decimal pl-3 leading-relaxed">
                    <li>Mengisi formulir melalui portal.</li>
                    <li>Melengkapi persyaratan teknis & administrasi.</li>
                    <li>Permohonan diproses bersama izin pemanfaatan tanah.</li>
                </ol>
            </div>

            <div class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm">
                <h3 class="text-[11px] font-bold text-blue-600 mb-2 uppercase tracking-wide flex items-center">
                    <i class="fas fa-folder-open mr-2"></i> Persyaratan Dokumen
                </h3>
                <ul class="text-[10px] text-gray-600 space-y-2">
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-0.5 mr-2"></i> Fotokopi KTP & Bukti Kepemilikan Tanah (Sertifikat/Letter C).</li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-0.5 mr-2"></i> Fotokopi SPT PBB tahun berjalan.</li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-0.5 mr-2"></i> Gambar denah, lokasi, & foto bangunan 3R.</li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-0.5 mr-2"></i> Surat Pernyataan (Kelayakan, Kebenaran dokumen, dll).</li>
                </ul>
            </div>
        </div>

   <h2 class="text-base font-extrabold text-gray-900 mb-3 mt-10 tracking-tight">Pusat Informasi</h2>

        <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
            <h3 class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-3.5 flex items-center">
                <i class="fas fa-question-circle mr-1 text-blue-500"></i> Tanya Jawab (FAQ)
            </h3>
            
            <div class="space-y-1.5">
                @foreach($faqs as $faq)
                    <details class="group border border-gray-100 rounded-md bg-gray-50/30 hover:bg-gray-100 transition-all duration-300">
                        <summary class="list-none flex justify-between items-center cursor-pointer p-3 font-semibold text-[10px] text-gray-800">
                            {{ $faq->pertanyaan }}
                            <span class="ml-2 transition-transform group-open:rotate-180 flex items-center">
                                <i class="fas fa-chevron-down text-[7px] text-gray-400"></i>
                            </span>
                        </summary>
                        <div class="px-3 pb-3 pt-0.5 text-[9.5px] text-gray-600 leading-relaxed border-t border-gray-100 mt-0.5">
                            {{ $faq->jawaban }}
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
        <div class="mt-6 text-center">
            <p class="text-[9px] text-gray-400">SIM-IMB Sleman &copy; 2026</p>
        </div>
    </div>
</body>
</html>