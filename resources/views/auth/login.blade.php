@extends('layouts.app')

@section('title', 'Login - Perizinan Sleman')

@section('container_class', 'from-[#DCEEFF] via-[#EDF5FF] to-[#E3F0FF] bg-gradient-to-b p-5 pt-6 mx-auto')

@section('content')
    <a href="{{ route('welcome') }}" class="absolute top-6 left-6 text-black hover:text-gray-600 transition z-20">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>

    <div class="w-full px-2 z-10 flex-grow flex flex-col justify-center">
        
        <div class="text-center">
            <h2 class="text-xl font-bold text-black tracking-wide">Login ke Akun Anda</h2>
            <p class="text-xs text-gray-500 mt-0.5 mb-6">Silakan masuk untuk melanjutkan</p>
            
            @if($errors->any())
                <div class="mb-3 p-2.5 bg-red-100 border border-red-300 text-red-700 text-[10px] font-semibold rounded-xl text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-3 p-2.5 bg-green-100 border border-green-300 text-green-700 text-[10px] font-semibold rounded-xl text-center">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="text-left">
                <label class="block text-xs font-bold text-black mb-1">Email</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" class="w-full px-3 py-2.5 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" required>
                    <i class="far fa-envelope absolute right-4 top-3.5 text-sm text-black"></i>
                </div>
            </div>

            <div class="text-left">
                <label class="block text-xs font-bold text-black mb-1">Password</label>
                <div class="relative">
                    <input type="password" 
                            id="passwordInput" 
                            name="password" 
                            placeholder="Masukkan password Anda" 
                            style="font-family: 'Poppins', sans-serif !important;"
                            class="w-full px-3 py-2.5 border border-gray-400 rounded-xl focus:outline-none focus:border-blue-500 text-xs text-black placeholder-gray-400 bg-white" 
                            required>
                    
                    <button type="button" id="togglePassword" class="absolute right-4 top-3 text-sm text-black cursor-pointer focus:outline-none">
                        <i class="far fa-eye-slash" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-md hover:bg-blue-700 transition text-sm tracking-wide mt-2">
                LOGIN
            </button>
        </form>
    </div>

    <div class="w-full text-center pb-12 px-2 z-10">
        <div class="flex items-center mb-4">
            <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
            <span class="px-2 text-[10px] text-black font-bold tracking-wide whitespace-nowrap">Atau Login Dengan</span>
            <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
        </div>
        
        <div class="grid grid-cols-2 gap-3 mb-4">
            <a href="{{ route('login.google.mock') }}" class="py-2 bg-white/60 backdrop-blur-md border border-blue-300/80 rounded-xl flex justify-center items-center hover:bg-white/90 shadow-sm transition cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-4 h-4" alt="Google">
            </a>
            <button type="button" class="py-2 bg-white/60 backdrop-blur-md border border-blue-300/80 rounded-xl flex justify-center items-center hover:bg-white/90 shadow-sm transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-4 h-4" alt="Facebook">
            </button>
        </div>

        <p class="text-[11px] text-black font-medium">Belum punya akun? <a href="{{ route('register') }}" class="text-[#2A65EA] font-bold hover:underline">Daftar di sini</a></p>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
@endsection