<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - Perizinan Sleman</title>
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

        <div class="flex justify-between items-center mb-8 relative z-10">
            <button onclick="toggleSidebar(true)" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-bars text-xs"></i>
            </button>
            <h2 class="text-sm font-bold text-gray-800">Profil Saya</h2>
            <div class="w-8"></div>
        </div>

        <div class="flex-grow space-y-6">
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3 border-4 border-white shadow-lg">
                    <i class="fas fa-user text-3xl"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-800">{{ $user->nama }}</h3>
                <p class="text-[10px] text-gray-400">{{ $user->email }}</p>
            </div>

            <div id="viewMode" class="border border-gray-200 rounded-2xl p-4 bg-white shadow-sm space-y-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-blue-600 uppercase tracking-wide">Data Profil</h3>
                    <button onclick="toggleEdit(true)" class="text-blue-600 hover:text-blue-800 transition">
                        <i class="fas fa-pencil-alt text-xs"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div><p class="text-[9px] font-bold text-gray-400 uppercase">Nama Lengkap</p><p class="text-[11px] font-semibold text-gray-800">{{ $user->nama }}</p></div>
                    <div><p class="text-[9px] font-bold text-gray-400 uppercase">NIK</p><p class="text-[11px] font-semibold text-gray-800">{{ $user->nik }}</p></div>
                    <div><p class="text-[9px] font-bold text-gray-400 uppercase">Alamat</p><p class="text-[11px] font-semibold text-gray-800">{{ $user->alamat }}</p></div>
                    <div><p class="text-[9px] font-bold text-gray-400 uppercase">Email</p><p class="text-[11px] font-semibold text-gray-800">{{ $user->email }}</p></div>
                </div>
            </div>

            <form id="editMode" action="{{ route('user.profil.update') }}" method="POST" class="hidden border border-blue-200 rounded-2xl p-4 bg-blue-50 shadow-sm space-y-4">
                @csrf
                <h3 class="text-[11px] font-bold text-blue-600 uppercase tracking-wide mb-2">Edit Data Diri</h3>
                
                <div>
                    <label class="block text-[9px] font-bold text-black-600 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $user->nama }}" class="w-full p-2.5 text-[11px] rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-[9px] font-bold text-black-600 uppercase mb-1">Alamat</label>
                    <textarea name="alamat" class="w-full p-2.5 text-[11px] rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $user->alamat }}</textarea>
                </div>

                <div>
                    <label class="block text-[9px] font-bold text-black-600 uppercase mb-1">Password Baru</label>
                    <input type="password" name="password" placeholder="********" class="w-full p-2.5 text-[11px] rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-[8px] text-gray-400 mt-1 italic">Kosongkan jika tidak ingin mengubah password.</p>
                </div>
                
                <div class="flex gap-2 pt-2">
                    <button type="submit" class="flex-1 py-2 bg-blue-600 text-white text-[11px] font-bold rounded-xl hover:bg-blue-700 transition">SIMPAN</button>
                    <button type="button" onclick="toggleEdit(false)" class="flex-1 py-2 bg-gray-200 text-gray-700 text-[11px] font-bold rounded-xl hover:bg-gray-300 transition">BATAL</button>
                </div>
            </form>
        </div>

        <div class="mt-8">
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w-full py-3 bg-red-50 text-red-600 font-bold rounded-xl text-xs hover:bg-red-100 transition">
                <i class="fas fa-sign-out-alt mr-2"></i> KELUAR AKUN
            </button>
        </div>
    </div>

    <script>
        function toggleEdit(isEdit) {
            document.getElementById('viewMode').classList.toggle('hidden', isEdit);
            document.getElementById('editMode').classList.toggle('hidden', !isEdit);
        }
    </script>
</body>
</html>