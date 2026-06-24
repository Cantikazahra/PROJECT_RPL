@extends('layouts.app')

@section('title', 'Sistem Perizinan Bangunan Sleman')

@section('container_class', 'from-[#DCEEFF] via-[#EDF5FF] to-[#E3F0FF] bg-gradient-to-b p-5')

@section('content')
    <div class="flex flex-col items-center flex-grow justify-center text-center px-2 z-10 mt-4">
        <img src="{{ asset('images/sleman.png') }}" 
             alt="Logo Sleman" 
             style="width: 95px !important; height: 120px !important; object-fit: fill !important;"
             class="mb-4 drop-shadow-sm">
        
        <h1 class="text-lg font-bold text-black leading-tight tracking-wide">
            Sistem Perizinan<br>Mendirikan Bangunan
        </h1>
        <p class="text-xs font-semibold text-gray-700 mt-1 tracking-wide">Kabupaten Sleman</p>

        <div class="w-full space-y-3 mt-8 px-4">
            <a href="{{ route('login') }}" class="block w-full py-2.5 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-sm hover:bg-blue-700 transition text-sm tracking-wide">
                Login
            </a>
            <a href="{{ route('register') }}" class="block w-full py-2.5 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-sm hover:bg-blue-700 transition text-sm tracking-wide">
                Daftar
            </a>
        </div>
    </div>

    <div class="w-full text-center pb-16 px-4 z-10">
        <div class="flex items-center mb-4">
            <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
            <span class="px-2 text-[10px] text-black font-bold tracking-wide whitespace-nowrap">Atau Login Dengan</span>
            <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
        </div>
        
        <div class="grid grid-cols-2 gap-3 px-1">
            <a href="{{ route('login.google.mock') }}" class="py-2.5 bg-white/60 backdrop-blur-md border border-blue-300/80 rounded-xl flex justify-center items-center hover:bg-white/90 shadow-sm transition cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-4 h-4" alt="Google">
            </a>
            <button type="button" class="py-2.5 bg-white/60 backdrop-blur-md border border-blue-300/80 rounded-xl flex justify-center items-center hover:bg-white/90 shadow-sm transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-4 h-4" alt="Facebook">
            </button>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-[190px] pointer-events-none z-0 mix-blend-multiply">
        <img src="{{ asset('images/bg awal.png') }}" alt="City Background" class="w-full h-full object-cover object-bottom opacity-[0.85]">
    </div>
@endsection