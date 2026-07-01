@extends('layouts.app') 

@section('title', 'Login Admin - Perizinan Sleman')

@section('container_class', 'from-[#DCEEFF] via-[#EDF5FF] to-[#E3F0FF] bg-gradient-to-b p-5')

@section('content')

    <a href="{{ route('welcome') }}" class="absolute top-6 left-6 text-black hover:text-gray-600 transition z-20">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>
    
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bg awal.png') }}" alt="City Background" class="w-full h-full object-cover">
    </div>

    <div class="relative z-10 w-full max-w-lg p-8 flex flex-col items-center">
        
        <img src="{{ asset('images/sleman.png') }}" 
             style="width: 80px !important; height: 105px !important; object-fit: fill !important; border-radius: 50%;"
             class="mb-6 drop-shadow-sm">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-black tracking-wide">SIM - IMB</h1>
            <p class="text-sm font-semibold text-gray-700 mt-1">Sistem Informasi Manajemen Izin Mendirikan Bangunan</p>
            <p class="text-sm font-semibold text-gray-700 mt-1">Kabupaten Sleman</p>
            <p class="text-lg font-bold text-black mt-4">Login ke Akun Admin</p>
        </div>

        @if ($errors->any())
            <div class="w-full max-w-sm mb-6 p-4 bg-[#FFECEC] border border-[#FFDADA] text-[#D9534F] text-xs text-center font-medium rounded-2xl shadow-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.process') }}" method="POST" class="w-full max-w-sm space-y-4">
            @csrf
            
            <div class="text-left">
                <label class="block text-sm font-bold text-black mb-1">Email</label>
                <input type="email" name="email" placeholder="Masukkan email Anda" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white" required>
            </div>

            <div class="text-left">
                <label class="block text-sm font-bold text-black mb-1">Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white" required>
            </div>

            <button type="submit" class="w-full py-3 bg-[#2A65EA] text-white font-bold rounded-md shadow-md hover:bg-blue-700 transition text-sm tracking-wide mt-2">
                LOGIN
            </button>
        </form>
    </div>
@endsection