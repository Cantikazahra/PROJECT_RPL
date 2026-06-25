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
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen p-2">

    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-hidden p-5 pt-10 flex flex-col">
        
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('user.pengajuan.detail', $pengajuan_id) }}" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-chevron-left text-[10px]"></i>
            </a>
            <h2 class="text-sm font-bold text-gray-800">Upload Dokumen</h2>
            <div class="w-8"></div>
        </div>

        <form id="uploadForm" action="{{ route('user.upload.process', $pengajuan_id) }}" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto no-scrollbar space-y-4 pb-4 pr-1">
            @csrf

            {{-- Pesan Error --}}
            @if ($errors->any())
                <div class="bg-red-50 p-2 rounded-xl">
                    @foreach ($errors->all() as $error)
                        <p class="text-[9px] text-red-600 font-bold">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-50 p-2 rounded-xl text-[9px] text-green-700 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $dokumen = [
                    ['id' => 'ktp', 'name' => 'file_ktp', 'label' => 'KTP Pemohon', 'desc' => 'Upload KTP asli'],
                    ['id' => 'tanah', 'name' => 'file_sertifikat', 'label' => 'Bukti Kepemilikan Tanah', 'desc' => 'Sertifikat / Letter C'],
                    ['id' => 'pbb', 'name' => 'file_spt_pbb', 'label' => 'Fotokopi SPT PBB', 'desc' => 'Pajak tahun berjalan'],
                    ['id' => 'surat', 'name' => 'file_pernyataan_3in1', 'label' => 'Surat Pernyataan', 'desc' => 'Template 3-in-1', 'is_template' => true],
                    ['id' => 'teknis', 'name' => 'file_gambar_bangunan', 'label' => 'Gambar & Foto Bangunan', 'desc' => 'Sketsa denah & foto tampak depan'],
                    ['id' => 'opsional', 'name' => 'file_pendukung_opsional', 'label' => 'Berkas Pendukung', 'desc' => 'Surat Sewa, KK Miskin, dll (Opsional)', 'is_optional' => true]
                ];
            @endphp

            @foreach($dokumen as $doc)
            <div class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm {{ isset($doc['is_optional']) ? 'border-dashed' : '' }}">
                @if(isset($doc['is_template']))
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-800">{{ $doc['label'] }}</label>
                            <p class="text-[9px] text-gray-400">{{ $doc['desc'] }}</p>
                        </div>
                        <a href="{{ asset('templates/format_surat_dispensasi_imb.docx') }}" download class="px-3 py-1 bg-blue-600 text-white font-bold rounded-lg text-[8px] hover:bg-blue-700 transition">
                            <i class="fas fa-download mr-1"></i> UNDUH
                        </a>
                    </div>
                @else
                    <label class="block text-[11px] font-bold text-gray-800 mb-0.5">{{ $doc['label'] }}</label>
                    <p class="text-[9px] text-gray-400 mb-3">{{ $doc['desc'] }}</p>
                @endif

                <div class="relative group">
                    {{-- 'required' telah dihapus agar bisa dicicil --}}
                    <input type="file" name="{{ $doc['name'] }}" id="input_{{ $doc['id'] }}" class="hidden" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" onchange="handleFile(this, 'label_{{ $doc['id'] }}', 'btn_{{ $doc['id'] }}')">
                    
                    <label for="input_{{ $doc['id'] }}" class="flex items-center justify-center p-3 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                        <i class="fas {{ $doc['id'] == 'teknis' ? 'fa-camera' : 'fa-cloud-upload-alt' }} text-blue-500 mr-2 text-sm"></i>
                        <span id="label_{{ $doc['id'] }}" class="text-[10px] text-gray-500 font-medium truncate">Klik untuk upload</span>
                    </label>

                    <button type="button" id="btn_{{ $doc['id'] }}" onclick="removeFile('input_{{ $doc['id'] }}', 'label_{{ $doc['id'] }}', 'btn_{{ $doc['id'] }}')" 
                            class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center hidden shadow-md">
                        <i class="fas fa-times text-[10px]"></i>
                    </button>
                </div>
            </div>
            @endforeach

            <button type="submit" id="submitBtn" class="w-full py-4 bg-[#2A65EA] text-white font-bold rounded-xl text-xs hover:bg-blue-700 transition shadow-lg mt-2">
                SIMPAN DOKUMEN
            </button>
        </form>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> MENYIMPAN...';
        });

        function handleFile(input, labelId, btnId) {
            const label = document.getElementById(labelId);
            const btn = document.getElementById(btnId);
            if (input.files.length > 0) {
                label.innerText = input.files[0].name;
                label.classList.add('text-blue-700', 'font-bold');
                btn.classList.remove('hidden');
            }
        }

        function removeFile(inputId, labelId, btnId) {
            const input = document.getElementById(inputId);
            const label = document.getElementById(labelId);
            const btn = document.getElementById(btnId);
            input.value = ""; 
            label.innerText = "Klik untuk upload";
            label.classList.remove('text-blue-700', 'font-bold');
            btn.classList.add('hidden');
        }
    </script>
</body>
</html>