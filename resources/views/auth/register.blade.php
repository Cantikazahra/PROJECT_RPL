@extends('layouts.app')

@section('title', 'Registrasi - Perizinan Sleman')

@section('container_class', 'from-[#DCEEFF] via-[#EDF5FF] to-[#E3F0FF] bg-gradient-to-b p-5 pt-6')

@section('content')
    <a href="{{ route('welcome') }}" class="absolute top-6 left-6 text-black hover:text-gray-600 transition z-20">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>

    <div class="w-full px-2 z-10 flex-grow flex flex-col justify-center mt-6">
        
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold text-black tracking-wide">Registrasi</h2>
            <p class="text-xs text-gray-500 mt-0.5">Buat akun baru untuk melanjutkan</p>
        </div>

        @if($errors->any())
            <div class="mb-3 p-2.5 bg-red-100 border border-red-300 text-red-700 text-[10px] font-semibold rounded-xl text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" class="space-y-2.5">
            @csrf
            
            <div class="text-left">
                <label class="block text-[11px] font-bold text-black mb-0.5">Nama Lengkap</label>
                <div class="relative">
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" class="w-full px-3 py-2 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" required>
                    <i class="far fa-user absolute right-4 top-2.5 text-xs text-black"></i>
                </div>
            </div>

            <div class="text-left">
                <label class="block text-[11px] font-bold text-black mb-0.5">NIK</label>
                <div class="relative">
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK" class="w-full px-3 py-2 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" required>
                    <i class="far fa-id-card absolute right-4 top-2.5 text-xs text-black"></i>
                </div>
            </div>

            <div class="text-left">
                <label class="block text-[11px] font-bold text-black mb-0.5">Alamat</label>
                <div class="relative">
                    <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat" class="w-full px-3 py-2 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" required>
                    <i class="fas fa-map-marker-alt absolute right-4 top-2.5 text-xs text-black"></i>
                </div>
            </div>

            <div class="text-left">
                <label class="block text-[11px] font-bold text-black mb-0.5">Email</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" class="w-full px-3 py-2 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" required>
                    <i class="far fa-envelope absolute right-4 top-2.5 text-xs text-black"></i>
                </div>
            </div>

            <div class="text-left">
                <label class="block text-[11px] font-bold text-black mb-0.5">Password</label>
                <div class="relative">
                    <input type="password" 
                            id="registerPassword" 
                            name="password" 
                            placeholder="Buat password" 
                            style="font-family: 'Poppins', sans-serif !important;"
                            class="w-full px-3 py-2 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" 
                            required>
                    
                    <button type="button" id="toggleRegisterPassword" class="absolute right-4 top-2 text-xs text-black cursor-pointer focus:outline-none">
                        <i class="far fa-eye-slash" id="eyeIconRegister"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-md hover:bg-blue-700 transition text-sm tracking-wide mt-2">
                DAFTAR
            </button>
        </form>
    </div>

    <div class="w-full text-center pb-4 px-2 z-10">
        <p class="text-[11px] text-black font-medium">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#2A65EA] font-bold hover:underline">Login di sini</a></p>
    </div>

    <script>
        const registerPassword = document.getElementById('registerPassword');
        const toggleRegisterPassword = document.getElementById('toggleRegisterPassword');
        const eyeIconRegister = document.getElementById('eyeIconRegister');

        toggleRegisterPassword.addEventListener('click', function () {
            const type = registerPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            registerPassword.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIconRegister.classList.remove('fa-eye-slash');
                eyeIconRegister.classList.add('fa-eye');
            } else {
                eyeIconRegister.classList.remove('fa-eye');
                eyeIconRegister.classList.add('fa-eye-slash');
            }
        });
    </script>
@endsection