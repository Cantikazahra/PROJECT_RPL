<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan - Perizinan Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen p-2 overflow-hidden">
    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-y-auto relative p-5 pt-10 flex flex-col justify-between no-scrollbar">
        
        @include('layouts.sidebar')

        <div class="w-full flex-grow flex flex-col relative z-10">
            <div class="flex justify-between items-center mb-6">
                <button onclick="toggleSidebar(true)" class="w-7 h-7 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                    <i class="fas fa-bars text-xs"></i>
                </button>
                <h2 class="text-sm font-bold text-gray-800 tracking-wide">Status Pengajuan</h2>
                <div class="w-7"></div>
            </div>

            @php
                $statusColor = match($pengajuan->status) {
                    'DISETUJUI' => 'text-green-600',
                    'MENUNGGU' => 'text-yellow-600',
                    'DITOLAK' => 'text-red-600',
                    default => 'text-gray-600'
                };
            @endphp

            <div class="border border-gray-300 rounded-2xl p-4 bg-white shadow-3xs text-left mb-4">
                <h3 class="text-xs font-bold text-gray-800 mb-4 tracking-wide">Informasi Status</h3>
                
                <div class="flex flex-col items-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-3">
                        <i class="far fa-clock text-2xl"></i>
                    </div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status Saat Ini</p>
                    <!-- Teks status sekarang dinamis warnanya -->
                    <p class="text-sm font-bold {{ $statusColor }} mt-1">{{ $pengajuan->status }}</p>
                </div>

                <table class="w-full text-[10px] text-gray-700 border-separate border-spacing-y-2">
                    <tr>
                        <td class="w-[40%] font-medium text-gray-500">Tanggal Pengajuan</td>
                        <td class="w-[60%] font-semibold text-gray-800">{{ date('d F Y', strtotime($pengajuan->tanggal_pengajuan)) }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500">No. Pengajuan</td>
                        <td class="font-semibold text-gray-800">{{ $pengajuan->no_pengajuan }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500">Catatan Petugas</td>
                        <td class="font-semibold text-gray-800 italic">{{ $pengajuan->catatan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-auto">
            <button onclick="location.reload()" class="w-full mt-6 py-3 bg-blue-100 text-blue-700 font-bold rounded-xl text-xs hover:bg-blue-200 transition tracking-wide">
                <i class="fas fa-sync-alt mr-2"></i> REFRESH STATUS
            </button>
        </div>

    </div>
</body>
</html>