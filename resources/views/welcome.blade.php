@extends('layouts.app')

@section('title', 'Sistem Perizinan Bangunan Sleman')

@section('container_class', 'from-[#DCEEFF] via-[#EDF5FF] to-[#E3F0FF] bg-gradient-to-b p-5')

@section('content')
<center class="relative z-10 h-full flex flex-col">
    <div class="flex flex-col h-full justify-between px-2 z-10 pt-8">
        
        <div class="flex flex-col items-center mt-6">
            <img src="{{ asset('images/sleman.png') }}" 
                alt="Logo Sleman" 
                style="width: 90px !important; height: 115px !important; object-fit: fill !important; border-radius: 50%;"
                class="mb-4 drop-shadow-sm">
            
            <h1 class="text-lg font-bold text-black leading-tight tracking-wide">
                SIM - IMB
            </h1>
            <h2 class="text-lg font-semibold text-gray-700 tracking-wide">
                Sistem Informasi Manajemen Izin Mendirikan Bangunan
            </h2>
            <p class="text-xs font-semibold text-gray-700 mt-1 tracking-wide">Kabupaten Sleman</p>

            <div class="w-full space-y-3 mt-8 px-4">
                <a href="{{ route('login') }}" class="block w-full py-2.5 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-sm transition text-sm tracking-wide">Login</a>
                <a href="{{ route('register') }}" class="block w-full py-2.5 bg-[#2A65EA] text-white font-semibold rounded-xl text-center shadow-sm transition text-sm tracking-wide">Daftar</a>
                <div class="pt-2 text-center">
                    <a href="{{ route('admin.login') }}" class="text-[10px] text-gray-600 hover:text-[#2A65EA] font-semibold underline">Khusus Admin: Login di sini</a>
                </div>
            </div>
        </div>

        <div class="w-full text-center pb-0 px-4">
            <div class="flex items-center mb-4">
                <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
                <span class="px-2 text-[10px] text-black font-bold tracking-wide whitespace-nowrap">Atau Login Dengan</span>
                <div class="flex-1 h-[1px] bg-gray-400 opacity-60"></div>
            </div>
            
            <div class="grid grid-cols-2 gap-3 px-1 mb-6">
                <a href="{{ route('login.google.mock') }}" class="py-2.5 bg-white/60 border border-blue-300 rounded-xl flex justify-center items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" class="w-4 h-4">
                </a>
                <button class="py-2.5 bg-white/60 border border-blue-300 rounded-xl flex justify-center items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-4 h-4">
                </button>
            </div>
        </div>
    </div>
</center>
    <div class="absolute bottom-0 left-0 w-full h-[160px] overflow-hidden rounded-b-3xl z-0">
        <img src="{{ asset('images/bg awal.png') }}" 
             alt="City Background" 
             class="w-full h-full object-cover object-bottom opacity-70">
    </div>
@endsection