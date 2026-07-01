<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 flex min-h-screen" x-data="{ sidebarOpen: true }">
    
    <aside x-show="sidebarOpen" class="w-64 bg-blue-900 text-white p-6 flex-shrink-0">
        <div class="mb-10 text-center">
            <img src="{{ asset('images/sleman.png') }}" class="w-16 mx-auto mb-2"> 
            <h1 class="text-sm font-bold">SIM - IMB<br>Sistem Informasi Manajemen Izin Mendirikan Bangunan</h1>
            <p>Kabupaten Sleman</p>
            <span class="text-[10px] bg-blue-700 px-2 py-1 rounded mt-2 inline-block">ADMIN</span>
        </div>
        
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="block p-3 rounded-lg text-sm transition-all {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-800 font-semibold' : 'hover:bg-blue-800' }}">
               Dashboard
            </a>

            <a href="{{ route('admin.pengajuan') }}" 
               class="block p-3 rounded-lg text-sm transition-all {{ request()->routeIs('admin.pengajuan*', 'admin.detail*') ? 'bg-blue-800 font-semibold' : 'hover:bg-blue-800' }}">
               Pengajuan
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left p-3 rounded-lg text-sm text-red-300 hover:bg-blue-800 hover:text-white transition-all">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-white p-4 flex justify-between items-center shadow-sm">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 text-xl">☰</button>
            <div class="flex items-center gap-2">
                <div class="text-right">
                    <p class="font-bold text-sm">Admin Dinas</p>
                    <p class="text-[10px] text-gray-500">Administrator</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">A</div>
            </div>
        </header>

        <main class="p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>