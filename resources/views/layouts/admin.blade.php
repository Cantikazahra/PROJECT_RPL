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
            <img src="{{ asset('images/sleman.png') }}" class="w-16 mx-auto mb-2"> <h1 class="text-sm font-bold">Sistem Perizinan<br>Mendirikan Bangunan</h1>
            <span class="text-[10px] bg-blue-700 px-2 py-1 rounded mt-2 inline-block">ADMIN</span>
        </div>
        <nav class="space-y-2">
            <a href="/admin/dashboard" class="block p-3 bg-blue-800 rounded-lg text-sm font-semibold">Dashboard</a>
            <a href="/admin/pengajuan" class="block p-3 hover:bg-blue-800 rounded-lg text-sm">Pengajuan</a>
            <a href="/logout" class="block p-3 text-red-300 text-sm">Logout</a>
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