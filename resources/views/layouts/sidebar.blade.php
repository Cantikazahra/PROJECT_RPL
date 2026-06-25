<div id="sidebarOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300" onclick="toggleSidebar(false)"></div>

<div id="sidebarMenu" class="absolute left-0 top-0 h-full w-[220px] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col bg-white">
    
    <div class="p-6 bg-gradient-to-br from-blue-600 to-blue-700 flex items-center gap-3">
        <div class="w-9 h-12 rounded-xl bg-white flex items-center justify-center overflow-hidden shadow-md border-2 border-white/20">
            <img src="{{ asset('images/sleman.png') }}" alt="Logo Sleman" class="w-full h-full object-cover">
        </div>
        <p class="font-bold text-white text-[13px] tracking-tight">SIM-IMB Sleman</p>
    </div>

    <nav class="flex-grow p-3 space-y-0.5">
        <a href="{{ route('user.dashboard') }}" class="flex items-center px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-50 rounded-lg transition">
            <i class="fas fa-home w-7"></i> Dashboard
        </a>
        <a href="{{ route('user.pengajuan') }}" class="flex items-center px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-50 rounded-lg transition">
            <i class="far fa-file-alt w-7"></i> Pengajuan Baru
        </a>
        
        @php
            $navId = \App\Models\Pengajuan::where('user_id', auth()->id())->latest()->value('id');
        @endphp

        <a href="{{ $navId ? route('user.status', $navId) : '#' }}" 
           class="flex items-center px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-50 rounded-lg transition">
            <i class="far fa-check-circle w-7"></i> Status Pengajuan
        </a>

        <a href="{{ route('user.riwayat') }}" class="flex items-center px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-50 rounded-lg transition">
            <i class="far fa-clock w-7"></i> Riwayat
        </a>
        <a href="{{ route('user.panduan') }}" class="flex items-center gap-3 px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-100 rounded-lg transition">
            <i class="far fa-list-alt w-4 text-center"></i> Pusat Informasi
        </a>
        <a href="{{ route('user.profil') }}" class="flex items-center gap-3 px-3 py-2.5 text-[12px] font-semibold text-gray-700 hover:bg-gray-100 rounded-lg transition">
            <i class="far fa-user w-4 text-center"></i> Profil
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