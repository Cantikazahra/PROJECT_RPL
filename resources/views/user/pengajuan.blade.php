<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan - Perizinan Sleman</title>
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

    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-y-auto p-5 pt-10 flex flex-col justify-between no-scrollbar">
        
        <div class="w-full flex-grow flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('user.dashboard') }}" class="w-7 h-7 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <h2 class="text-sm font-bold text-gray-800 tracking-wide">Form Pengajuan</h2>
                <div class="w-7"></div>
            </div>

            <div class="text-left mb-3">
                <h3 class="text-xs font-bold text-gray-800 mb-0.5">Form Pengajuan Izin</h3>
                <p class="text-[10px] text-gray-400">Silakan isi data tanah dan bangunan Anda</p>
            </div>

            @if($errors->any())
                <div class="mb-3 p-2.5 bg-red-100 border border-red-300 text-red-700 text-[10px] font-semibold rounded-xl text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('user.pengajuan.process') }}" method="POST" class="space-y-3.5 text-left flex-grow flex flex-col justify-between">
                @csrf
                
                <div class="space-y-3 flex-grow overflow-y-auto no-scrollbar max-h-[430px] pr-0.5">
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-1">Lokasi Lengkap Tanah / Bangunan</label>
                        <textarea name="lokasi_tanah" placeholder="Nama Jalan, Padukuhan, RT/RW, Desa, Kecamatan" rows="2.5" class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>{{ old('lokasi_tanah') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-1">Nomor Sertifikat / Bukti Tanah</label>
                        <input type="text" name="nomor_hak_tanah" value="{{ old('nomor_hak_tanah') }}" 
                            placeholder="Contoh: SHM No. 1245 atau Letter C No. 452" 
                            class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>
                        <span class="block text-[8.5px] text-gray-400 mt-0.5">Bisa diisi nomor SHM, Letter C, atau berkas adat sejenisnya.</span>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-1">Luas Tanah (m²)</label>
                            <input type="number" name="luas_tanah" value="{{ old('luas_tanah') }}" 
                                min="1" 
                                placeholder="Contoh: 150" 
                                class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>
                        </div>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 mb-1">Tahun Pembangunan</label>
                            <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri') }}" 
                                min="1900" max="{{ date('Y') }}"
                                placeholder="Contoh: {{ date('Y') }}" 
                                class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-1">Jenis Fungsi Bangunan</label>
                        <select name="jenis_bangunan" class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>
                            <option value="" disabled selected>Pilih jenis bangunan</option>
                            <option value="Rumah Tinggal" {{ old('jenis_bangunan') == 'Rumah Tinggal' ? 'selected' : '' }}>Rumah Tinggal Sederhana</option>
                            <option value="Ruko" {{ old('jenis_bangunan') == 'Ruko' ? 'selected' : '' }}>Rumah Toko Tunggal (≤ 50 m²)</option>
                            <option value="Perkantoran" {{ old('jenis_bangunan') == 'Perkantoran' ? 'selected' : '' }}>Rumah Kantor Tunggal</option>
                            <option value="Gudang" {{ old('jenis_bangunan') == 'Gudang' ? 'selected' : '' }}>Gudang Kecil Penyimpanan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-700 mb-1">Tujuan Pembangunan</label>
                        <textarea name="tujuan_pembangunan" placeholder="Contoh: Digunakan sebagai fungsi hunian tempat tinggal keluarga" rows="2.5" class="w-full px-3 py-2 border border-gray-400 rounded-xl text-xs focus:outline-none focus:border-blue-500 bg-white text-black" required>{{ old('tujuan_pembangunan') }}</textarea>
                    </div>

                </div>

                <div class="grid grid-cols-2 gap-3 pt-3 mt-auto">
                    <button type="reset" class="py-2.5 border border-gray-300 text-gray-700 font-bold rounded-xl text-[11px] bg-gray-50 hover:bg-gray-100 transition">RESET</button>
                    <button type="submit" class="py-2.5 bg-[#2A65EA] text-white font-bold rounded-xl text-[11px] hover:bg-blue-700 transition">LANJUT</button>
                </div>
            </form>
        </div>

        <div class="w-full text-center text-[9px] text-gray-400 mt-3">
            SIM-IMB Kabupaten Sleman &copy; 2026
        </div>

    </div>
</body>
</html>