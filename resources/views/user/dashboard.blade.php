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
        
        <div class="w-full flex-grow flex flex-col">
            
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
                        <p class="text-xs font-bold text-gray-800">{{ Auth::user()->name ?? 'Nama User' }}</p>
                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email ?? 'user@email.com' }}</p>
                    </div>
                    <a href="#" class="block px-4 py-2 text-[11px] text-gray-700 hover:bg-gray-50 flex items-center space-x-2">
                        <i class="far fa-id-card text-gray-400 w-4"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="#" class="block px-4 py-2 text-[11px] text-gray-700 hover:bg-gray-50 flex items-center space-x-2 border-b border-gray-100">
                        <i class="fas fa-cog text-gray-400 w-4"></i>
                        <span>Pengaturan</span>
                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-[11px] text-red-600 hover:bg-red-50 font-medium flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt w-4"></i>
                        <span>Keluar Akun</span>
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

<div class="text-left mb-5">
                <h3 class="text-xs font-bold text-gray-800 mb-2">Status Pengajuan Terakhir</h3>
                
                @if(isset($latest) && $latest != null)
                    <a href="{{ route('user.pengajuan.detail', $latest->id) }}" class="w-full border border-gray-300 rounded-2xl p-4 flex items-center space-x-4 bg-white shadow-xs hover:bg-gray-50 transition block group text-left">
                        <div class="w-9 h-9 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-500 group-hover:bg-blue-100 transition">
                            <i class="far fa-file-text text-xs"></i>
                        </div>
                        <!-- 🔥 KONDISI IF: Mengganti text-gray-500 menjadi text-gray-900 agar hitam tegas -->
                        <div class="flex-1 text-[11px] space-y-1 text-gray-900">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Status</span>
                                @if($latest->status == 'DISETUJUI')
                                    <span class="font-bold text-green-600">{{ $latest->status }}</span>
                                @elseif($latest->status == 'MENUNGGU')
                                    <span class="font-bold text-blue-600">{{ $latest->status }}</span>
                                @elseif($latest->status == 'PERLU PERBAIKAN')
                                    <span class="font-bold text-amber-500">{{ $latest->status }}</span>
                                @else
                                    <span class="font-bold text-red-600">{{ $latest->status }}</span>
                                @endif
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Tanggal</span>
                                <span class="font-medium text-gray-800">{{ date('d-m-Y', strtotime($latest->tanggal_pengajuan)) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">No. Pengajuan</span>
                                <span class="font-mono font-semibold text-gray-800 flex items-center">
                                    {{ $latest->no_pengajuan }}
                                    <i class="fas fa-chevron-right text-[8px] text-gray-400 ml-1.5 group-hover:text-blue-600 transition"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @else
                    <!-- 🔥 KONDISI ELSE: Label juga dipastikan menggunakan text-gray-900 -->
                    <div class="border border-gray-300 rounded-2xl p-4 bg-white shadow-3xs flex items-center space-x-4 text-left">
                        <div class="w-9 h-9 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-500 shrink-0">
                            <i class="far fa-file-alt text-xs"></i>
                        </div>
                        
                        <div class="flex-1 text-[11px] space-y-1">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">Status</span>
                                <span class="font-bold text-yellow-600 tracking-wide">{{ $pengajuanTerakhir->status ?? 'BELUM ADA' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-900">Tanggal</span>
                                <span class="font-medium text-gray-800">{{ isset($pengajuanTerakhir) ? \Carbon\Carbon::parse($pengajuanTerakhir->tanggal_pengajuan)->format('d-m-Y') : '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">No. Pengajuan</span>
                                @if(isset($pengajuanTerakhir))
                                    <a href="{{ route('user.pengajuan.detail', $pengajuanTerakhir->id) }}" class="font-mono font-semibold text-gray-800 flex items-center hover:text-blue-600 transition">
                                        {{ $pengajuanTerakhir->no_pengajuan }}
                                        <i class="fas fa-chevron-right text-[9px] text-gray-400 ml-1"></i>
                                    </a>
                                @else
                                    <span class="font-medium text-gray-400">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-left">
                <h3 class="text-xs font-bold text-gray-800 mb-2">Ringkasan</h3>
                <div class="grid grid-cols-3 gap-2.5 text-center text-[10px] font-bold">
                    
                    <a href="{{ route('user.riwayat') }}" class="bg-blue-50/70 border border-blue-200 rounded-xl p-2.5 text-blue-800 shadow-2xs block hover:bg-blue-100 transition cursor-pointer">
                        <i class="fas fa-layer-group block text-xs mb-0.5 text-blue-600"></i>
                        <span class="text-gray-400 font-medium">Total</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $total }}</p>
                    </a>

                    <a href="{{ route('user.riwayat', ['status' => 'MENUNGGU']) }}" class="bg-yellow-50/70 border border-yellow-200 rounded-xl p-2.5 text-yellow-800 shadow-2xs block hover:bg-yellow-100 transition cursor-pointer">
                        <i class="far fa-clock block text-xs mb-0.5 text-yellow-600"></i>
                        <span class="text-gray-400 font-medium">Menunggu</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $menunggu }}</p>
                    </a>

                    <a href="{{ route('user.riwayat', ['status' => 'DISETUJUI']) }}" class="bg-green-50/70 border border-green-200 rounded-xl p-2.5 text-green-800 shadow-2xs block hover:bg-green-100 transition cursor-pointer">
                        <i class="far fa-check-circle block text-xs mb-0.5 text-green-600"></i>
                        <span class="text-gray-400 font-medium">Disetujui</span>
                        <p class="text-base font-bold text-gray-800 mt-0.5">{{ $disetujui }}</p>
                    </a>

                </div>
            </div>
        </div>

        <div class="w-full text-center text-[9px] text-gray-400 pb-1 mt-4">
            SIM-IMB Kabupaten Sleman &copy; 2026
        </div>

        <div id="sidebarOverlay" onclick="toggleSidebar(false)" class="hidden absolute inset-0 bg-black/40 z-40 rounded-[36px] transition-opacity duration-300 opacity-0"></div>
        
        <div id="sidebarMenu" class="absolute top-0 left-0 h-full w-[250px] bg-slate-900 rounded-l-[36px] z-50 p-4 pt-10 transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between text-left">
            <div>
                <div class="flex justify-between items-center mb-4 px-2">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-shield-alt text-blue-500 text-sm"></i>
                        <span class="text-white text-xs font-bold tracking-wide">SIM-IMB Sleman</span>
                    </div>
                    <button onclick="toggleSidebar(false)" class="text-gray-400 hover:text-white focus:outline-none">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('user.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }} rounded-xl text-[11px] font-medium transition">
                        <i class="fas fa-home w-4 text-center text-xs"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('user.pengajuan') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('user.pengajuan') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }} rounded-xl text-[11px] font-medium transition">
                        <i class="far fa-file-alt w-4 text-center text-xs"></i>
                        <span>Ajukan Izin Baru</span>
                    </a>
                    <a href="{{ route('user.status') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('user.status') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }} rounded-xl text-[11px] font-medium transition">
                        <i class="fas fa-tasks w-4 text-center text-xs"></i>
                        <span>Status Pengajuan</span>
                    </a>
                    <a href="{{ route('user.riwayat') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('user.riwayat') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }} rounded-xl text-[11px] font-medium transition">
                        <i class="fas fa-history w-4 text-center text-xs"></i>
                        <span>Riwayat Permohonan</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:bg-slate-800 rounded-xl text-[11px] font-medium transition">
                        <i class="fas fa-folder-open w-4 text-center text-xs"></i>
                        <span>Dokumen Saya</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:bg-slate-800 rounded-xl text-[11px] font-medium transition">
                        <i class="far fa-bell w-4 text-center text-xs"></i>
                        <span>Notifikasi</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:bg-slate-800 rounded-xl text-[11px] font-medium transition">
                        <i class="fas fa-book w-4 text-center text-xs"></i>
                        <span>Panduan Perizinan</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:bg-slate-800 rounded-xl text-[11px] font-medium transition">
                        <i class="far fa-comment-dots w-4 text-center text-xs"></i>
                        <span>Hubungi Bantuan</span>
                    </a>
                </nav>
            </div>

            <div class="border-t border-slate-800 pt-3 mb-1">
                <div class="flex items-center space-x-2.5 mb-2.5 px-1">
                    <div class="w-7 h-7 rounded-full bg-slate-700 flex items-center justify-center text-slate-300 font-bold text-[10px]">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-white text-[11px] font-bold truncate">{{ Auth::user()->name ?? 'User Pemohon' }}</p>
                        <p class="text-gray-500 text-[9px] truncate">Pemohon IMB</p>
                    </div>
                </div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center space-x-3 px-3 py-2 text-red-400 hover:bg-red-950/30 rounded-xl text-[11px] font-medium transition">
                    <i class="fas fa-sign-out-alt w-4 text-center text-xs"></i>
                    <span>Keluar Aplikasi</span>
                </a>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>

    </div>

    <script src="{{ asset('app.js') }}" defer></script>
</body>
</html>