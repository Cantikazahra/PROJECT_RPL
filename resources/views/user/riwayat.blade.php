@extends('layouts.app')

@section('title', 'Riwayat Pengajuan - Perizinan Sleman')

@section('content')
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <div class="w-full pt-4 flex flex-col flex-grow text-left relative z-10">
        
        <!-- Header dengan Tombol Menu (Garis 3) -->
        <div class="flex justify-between items-center mb-5">
            <button onclick="toggleSidebar(true)" class="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                <i class="fas fa-bars text-xs"></i>
            </button>
            <h2 class="text-sm font-bold text-gray-800 tracking-wide">{{ $judul }}</h2>
            <div class="w-8"></div>
        </div>

        <div class="mb-1">
            <p class="text-[11px] font-bold text-gray-700 tracking-wide">Riwayat Pengajuan Izin Anda</p>
        </div>

        <div class="flex-grow space-y-3 overflow-y-auto no-scrollbar pb-4 mt-2">
            
            @forelse($daftarPengajuan as $item)
                @php
                    $statusConfig = match($item->status) {
                        'DISETUJUI'       => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-100'],
                        'MENUNGGU'        => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'border' => 'border-yellow-100'],
                        'PERLU PERBAIKAN' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-500', 'border' => 'border-amber-100'],
                        'DITOLAK'         => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-100'],
                        default           => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'border' => 'border-gray-100'],
                    };

                    $statusClass = "{$statusConfig['text']} {$statusConfig['bg']} {$statusConfig['border']}";
                    $iconClass = "{$statusConfig['text']} {$statusConfig['bg']} {$statusConfig['border']}";
                @endphp

                <a href="{{ route('user.pengajuan.detail', $item->id) }}" class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs flex items-center justify-between hover:bg-gray-50/80 transition cursor-pointer block">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full border flex items-center justify-center shrink-0 {{ $iconClass }}">
                            <i class="far fa-file-alt text-xs"></i>
                        </div>
                        
                        <div class="space-y-0.5">
                            <p class="text-[11px] font-bold text-gray-900 tracking-wide">
                                {{ $item->no_pengajuan }}
                            </p>
                            <p class="text-[10px] text-gray-700 font-medium capitalize">
                                <i class="fas fa-map-marker-alt text-[9px] text-gray-400 mr-0.5"></i>
                                {{ $item->lokasi_tanah }}
                            </p>
                            <p class="text-[9px] text-gray-400 font-medium">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-1.5 shrink-0">
                        <span class="font-bold border px-2 py-0.5 rounded-lg text-[8px] tracking-wide {{ $statusClass }}">
                            {{ $item->status }}
                        </span>
                        <i class="fas fa-chevron-right text-[9px] text-gray-400"></i>
                    </div>
                </a>
            @empty
                <div class="text-center py-20">
                    <i class="fas fa-folder-open text-gray-300 text-3xl mb-2.5"></i>
                    <p class="text-xs text-gray-400">Belum ada riwayat permohonan izin.</p>
                </div>
            @endforelse

        </div>

        <div class="w-full pt-3 border-t border-gray-100 flex justify-center z-10">
            {{ $daftarPengajuan->links('pagination::tailwind') }}
        </div>

    </div>
@endsection