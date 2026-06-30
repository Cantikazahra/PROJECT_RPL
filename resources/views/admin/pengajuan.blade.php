@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-black text-gray-800">Daftar Pengajuan</h2>

    <form method="GET" action="{{ route('admin.pengajuan') }}" class="flex gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / no. pengajuan..." 
               class="flex-1 p-3 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
        
        <div class="relative inline-block">
            <select name="status" 
                    class="appearance-none p-3 pl-4 pr-10 border rounded-lg text-sm outline-none shadow-sm bg-white cursor-pointer" 
                    onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            
            <!-- Ikon Panah Kustom -->
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px]">
                <tr>
                    <th class="p-4">No. Pengajuan</th>
                    <th class="p-4">Pemohon</th>
                    <th class="p-4">Jenis Bangunan</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                @forelse($pengajuans as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold">{{ $item->no_pengajuan }}</td>
                    <td class="p-4">{{ $item->user->nama ?? '-' }}</td>
                    <td class="p-4">{{ $item->jenis_bangunan }}</td>
                    <td class="p-4 text-gray-500">
                        {{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d M Y') : '-' }}
                    </td>
                    <td class="p-4">
                        @php
                            $status = strtolower($item->status);
                            $badge = [
                                'menunggu'  => 'bg-yellow-100 text-yellow-700',
                                'disetujui' => 'bg-green-100 text-green-700',
                                'ditolak'   => 'bg-red-100 text-red-700',
                            ][$status] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $badge }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-4">
                        <a href="{{ route('admin.detail', $item->id) }}" class="text-blue-600 font-bold hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-10 text-center text-gray-400 text-sm">Data pengajuan tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="p-4 border-t border-gray-100">
            {{ $pengajuans->links() }}
        </div>
    </div>
</div>
@endsection