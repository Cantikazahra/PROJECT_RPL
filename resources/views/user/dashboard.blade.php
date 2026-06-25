<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perizinan Sleman</title>
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
        @include('layouts.sidebar')
        <div class="w-full flex-grow flex flex-col">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4 relative z-10">
                <button onclick="toggleSidebar(true)" class="text-gray-700 hover:text-blue-600 transition focus:outline-none">
                    <i class="fas fa-bars text-base cursor-pointer"></i>
                </button>
                <h2 class="text-sm font-bold text-gray-800 tracking-wide">Dashboard</h2>
                <button onclick="toggleProfileDropdown()" class="w-7 h-7 rounded-full bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 hover:bg-blue-100 transition focus:outline-none">
                    <i class="far fa-user text-xs"></i>
                </button>

                <div id="profileDropdown" class="hidden absolute right-0 top-9 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-30 text-left">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-xs font-bold text-gray-800">{{ Auth::user()->name ?? 'Nama Pemohon' }}</p>
                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->nama }}</p>
                    </div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-[11px] text-red-600 hover:bg-red-50 font-medium flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt w-4"></i> <span>Keluar Akun</span>
                    </a>
                </div>
            </div>

            <div class="w-full flex justify-center mb-4">
                <img src="{{ asset('images/rumah.png') }}" class="w-45 h-45 object-contain" alt="Rumah">
            </div>

            <a href="{{ route('user.pengajuan') }}" class="w-full border border-gray-300 rounded-2xl p-3.5 flex items-center justify-between hover:bg-gray-50 transition mb-5 shadow-xs">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                        <i class="far fa-file-alt text-base"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-gray-800">Ajukan Izin Baru</p>
                        <p class="text-[9px] text-gray-400">Buat pengajuan izin bangunan baru</p>
                    </div>
                </div>
                <i class="fas fa-chevron-right text-[10px] text-blue-600 mr-1"></i>
            </a>

            {{-- Status Pengajuan Terakhir --}}
            <div class="text-left mb-5">
                <h3 class="text-xs font-bold text-gray-800 mb-2">Status Pengajuan Terakhir</h3>
                
                @if(isset($latest) && $latest != null)
                    @php
                        $statusColor = match($latest->status) {
                            'DISETUJUI' => 'text-green-600',
                            'MENUNGGU' => 'text-yellow-600',
                            'PERLU PERBAIKAN' => 'text-amber-500',
                            default => 'text-red-600'
                        };
                    @endphp
                    <a href="{{ route('user.status', $latest->id) }}" class="w-full border border-gray-300 rounded-2xl p-4 flex items-center space-x-4 bg-white shadow-xs hover:bg-gray-50 transition block group text-left">
                        <div class="w-9 h-9 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-500">
                            <i class="far fa-file-text text-xs"></i>
                        </div>
                        <div class="flex-1 text-[11px] space-y-1 text-gray-900">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Status</span>
                                <span class="font-bold {{ $statusColor }} tracking-wide">{{ $latest->status }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Tanggal</span>
                                <span class="font-medium text-gray-800">{{ date('d-m-Y', strtotime($latest->tanggal_pengajuan)) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">No. Pengajuan</span>
                                <span class="font-mono font-semibold text-gray-800">{{ $latest->no_pengajuan }}</span>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="border border-gray-300 rounded-2xl p-4 bg-white text-[11px] text-gray-400 text-center">
                        Belum ada pengajuan izin.
                    </div>
                @endif
            </div>

            {{-- Ringkasan --}}
            <div class="text-left">
                <h3 class="text-xs font-bold text-gray-800 mb-2">Ringkasan</h3>
                <div class="grid grid-cols-3 gap-2.5 text-center text-[10px] font-bold">
                    <a href="{{ route('user.riwayat') }}" class="bg-blue-50/70 border border-blue-200 rounded-xl p-2.5 text-blue-800 hover:bg-blue-100 transition">
                        <i class="fas fa-layer-group block text-xs mb-0.5 text-blue-600"></i>
                        <span class="text-gray-400 font-medium">Total</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $total ?? 0 }}</p>
                    </a>
                    <a href="{{ route('user.riwayat', ['status' => 'MENUNGGU']) }}" class="bg-yellow-50/70 border border-yellow-200 rounded-xl p-2.5 text-yellow-800 hover:bg-yellow-100 transition">
                        <i class="far fa-clock block text-xs mb-0.5 text-yellow-600"></i>
                        <span class="text-gray-400 font-medium">Menunggu</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $menunggu ?? 0 }}</p>
                    </a>
                    <a href="{{ route('user.riwayat', ['status' => 'DISETUJUI']) }}" class="bg-green-50/70 border border-green-200 rounded-xl p-2.5 text-green-800 hover:bg-green-100 transition">
                        <i class="far fa-check-circle block text-xs mb-0.5 text-green-600"></i>
                        <span class="text-gray-400 font-medium">Disetujui</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $disetujui ?? 0 }}</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full text-center text-[9px] text-gray-400 pb-1 mt-4">
            SIM-IMB Kabupaten Sleman &copy; 2026
        </div>

        <script>
            function toggleSidebar(show) {
                const sidebar = document.getElementById('sidebarMenu');
                const overlay = document.getElementById('sidebarOverlay');
                
                if (show) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                }
            }
            function toggleProfileDropdown() {
                document.getElementById('profileDropdown').classList.toggle('hidden');
            }
        </script>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
</body>
</html>