<div id="sidebarOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300" onclick="toggleSidebar(false)"></div>

<div id="sidebarMenu" class="absolute left-0 top-0 h-full w-[190px] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col bg-white">
    
    <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-700 flex flex-col items-center justify-center text-center">
        <img src="{{ asset('images/sleman.png') }}" alt="Logo Sleman" class="w-16 h-16 rounded-full object-cover mb-4 shadow-md">
        
        <div class="space-y-0.5">
            <h2 class="font-bold text-white text-[12px]">SIM - IMB</h2>
            <p class="text-blue-100 text-[10px] leading-tight font-medium">Sistem Informasi Manajemen<br>Izin Mendirikan Bangunan</p>
            <p class="text-white font-semibold text-[9px] pt-1">Kabupaten Sleman</p>
            
            <div class="mt-3">
                <span class="bg-blue-800 text-white text-[8px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                    Pemohon
                </span>
            </div>
        </div>
    </div>

    <nav class="flex-grow p-2 space-y-0.5">
        <a href="{{ route('user.dashboard') }}" class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="fas fa-home w-6"></i> Dashboard
        </a>
        <a href="{{ route('user.pengajuan') }}" class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="far fa-file-alt w-6"></i> Pengajuan Baru
        </a>
        
        @php
            $navId = \App\Models\Pengajuan::where('user_id', auth()->id())->latest()->value('id');
        @endphp

        <a href="{{ $navId ? route('user.status', $navId) : '#' }}" 
           class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="far fa-check-circle w-6"></i> Status Pengajuan
        </a>

        <a href="{{ route('user.riwayat') }}" class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="far fa-clock w-6"></i> Riwayat
        </a>
        <a href="{{ route('user.panduan') }}" class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="far fa-list-alt w-6"></i> Pusat Informasi
        </a>
        <a href="{{ route('user.profil') }}" class="flex items-center px-3 py-2 text-[10px] font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
            <i class="far fa-user w-6"></i> Profil
        </a>
    </nav>
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
</script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>