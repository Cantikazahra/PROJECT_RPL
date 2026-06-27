@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Dashboard</h2>
            <p class="text-gray-500 text-sm">Selamat datang kembali, <span class="font-bold text-blue-900">Admin!</span></p>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4">
        @php
            $stats = [
                ['label' => 'Total Pengajuan', 'value' => $data['total'], 'color' => 'border-blue-500 text-blue-600'],
                ['label' => 'Menunggu', 'value' => $data['menunggu'], 'color' => 'border-yellow-500 text-yellow-600'],
                ['label' => 'Disetujui', 'value' => $data['disetujui'], 'color' => 'border-green-500 text-green-600'],
                ['label' => 'Ditolak', 'value' => $data['ditolak'], 'color' => 'border-red-500 text-red-600'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-xl border-l-4 {{ $stat['color'] }} shadow-sm">
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">{{ $stat['label'] }}</p>
            <p class="text-3xl font-black mt-1">{{ $stat['value'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Pengajuan Terbaru</h3>
            <a href="/admin/pengajuan" class="text-[10px] bg-blue-900 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-800 transition">Lihat Semua</a>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px]">
                <tr>
                    <th class="p-4">No. Pengajuan</th>
                    <th class="p-4">Pemohon</th>
                    <th class="p-4">Jenis Bangunan</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                @foreach($data['pengajuanTerbaru'] as $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold">{{ $item->no_pengajuan }}</td>
                    <td class="p-4">{{ $item->user->nama ?? 'Tanpa Nama' }}</td>
                    <td class="p-4">{{ $item->jenis_bangunan ?? '-' }}</td>
                    <td class="p-4 text-gray-500">
                        {{ $item->tanggal_pengajuan ? $item->tanggal_pengajuan->format('d M Y') : '-' }}
                    </td>
                    <td class="p-4">
                        @php
                            $status = strtolower($item->status);
                            $badge = [
                                'menunggu' => 'bg-yellow-100 text-yellow-700',
                                'disetujui' => 'bg-green-100 text-green-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                            ][$status] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $badge }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <a href="{{ route('admin.detail', $item->id) }}" class="text-blue-600 font-bold hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection