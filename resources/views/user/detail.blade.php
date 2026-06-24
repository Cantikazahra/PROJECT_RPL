<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan - Perizinan Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-900 flex justify-center items-center min-h-screen p-2 overflow-hidden">

    <div class="w-[340px] h-[680px] bg-white rounded-[36px] shadow-2xl overflow-y-auto relative p-5 pt-10 flex flex-col justify-between no-scrollbar">
        
        <div class="w-full flex-grow flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('user.dashboard') }}" class="w-7 h-7 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition focus:outline-none">
                    <i class="fas fa-chevron-left text-xs"></i>
                </a>
                <h2 class="text-sm font-bold text-gray-800 tracking-wide">Detail Pengajuan</h2>
                <div class="w-7"></div>
            </div>

            <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs text-left mb-3">
                <h3 class="text-xs font-bold text-gray-800 mb-2 tracking-wide">Detail Pengajuan</h3>
                <table class="w-full text-[10px] text-gray-700 border-separate border-spacing-y-1">
                    <tr>
                        <td class="w-[40%] font-medium text-gray-500 align-top">No. Pengajuan</td>
                        <td class="w-[60%] font-semibold text-gray-800 align-top">{{ $pengajuan->no_pengajuan }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Tanggal Pengajuan</td>
                        <td class="font-semibold text-gray-800 align-top">{{ date('d F Y', strtotime($pengajuan->tanggal_pengajuan)) }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">No. Sertifikat/Tanah</td>
                        <td class="font-semibold text-gray-800 align-top break-words">{{ $pengajuan->nomor_hak_tanah }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Lokasi Tanah</td>
                        <td class="font-semibold text-gray-800 align-top break-words leading-relaxed">{{ $pengajuan->lokasi_tanah }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Luas Tanah</td>
                        <td class="font-semibold text-gray-800 align-top">{{ $pengajuan->luas_tanah }} m²</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Tahun Rencana Bangun</td>
                        <td class="font-semibold text-gray-800 align-top">{{ $pengajuan->tahun_rencana_bangun }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Jenis Bangunan</td>
                        <td class="font-semibold text-gray-800 align-top">{{ $pengajuan->jenis_bangunan }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-top">Tujuan Pembangunan</td>
                        <td class="font-semibold text-gray-800 align-top break-words leading-relaxed">{{ $pengajuan->tujuan_pembangunan }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium text-gray-500 align-middle">Status</td>
                        <td class="align-middle">
                            @if($pengajuan->status == 'DISETUJUI')
                                <span class="px-2.5 py-0.5 rounded-md text-[9px] font-bold bg-green-100 text-green-700 border border-green-200">{{ $pengajuan->status }}</span>
                            @elseif($pengajuan->status == 'MENUNGGU')
                                <span class="px-2.5 py-0.5 rounded-md text-[9px] font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">{{ $pengajuan->status }}</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-md text-[9px] font-bold bg-amber-100 text-amber-700 border border-amber-200">{{ $pengajuan->status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="border border-gray-300 rounded-2xl p-3.5 bg-white shadow-3xs text-left mb-4 flex-grow flex flex-col">
                <h3 class="text-xs font-bold text-gray-800 mb-2 tracking-wide">Dokumen Persyaratan</h3>
                
                <div class="space-y-2 overflow-y-auto no-scrollbar max-h-[190px] pr-0.5">
                    <div class="flex justify-between items-center text-[10px] border-b border-gray-50 pb-1.5">
                        <span class="font-semibold text-gray-700 truncate max-w-[160px]"><i class="far fa-file-alt text-gray-400 mr-1.5"></i>KTP Pemohon</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_ktp ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_ktp).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">Belum ada</span>' !!}
                    </div>

                    <div class="flex justify-between items-center text-[10px] border-b border-gray-50 pb-1.5">
                        <span class="font-semibold text-gray-700 truncate max-w-[160px]"><i class="far fa-file-alt text-gray-400 mr-1.5"></i>Bukti Kepemilikan Tanah</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_sertifikat ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_sertifikat).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">Belum ada</span>' !!}
                    </div>

                    <div class="flex justify-between items-center text-[10px] border-b border-gray-50 pb-1.5">
                        <span class="font-semibold text-gray-700 truncate max-w-[160px]"><i class="far fa-file-alt text-gray-400 mr-1.5"></i>Fotokopi SPT PBB</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_spt_pbb ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_spt_pbb).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">Belum ada</span>' !!}
                    </div>

                    <div class="flex justify-between items-center text-[10px] border-b border-gray-50 pb-1.5">
                        <span class="font-semibold text-gray-700 truncate max-w-[160px]"><i class="far fa-file-alt text-gray-400 mr-1.5"></i>Surat Pernyataan (3-in-1)</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_pernyataan_3in1 ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_pernyataan_3in1).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">Belum ada</span>' !!}
                    </div>

                    <div class="flex justify-between items-center text-[10px] border-b border-gray-50 pb-1.5">
                        <span class="font-semibold text-gray-700 truncate max-w-[160px]"><i class="far fa-image text-gray-400 mr-1.5"></i>Gambar Denah & Foto 3R</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_gambar_bangunan ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_gambar_bangunan).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">Belum ada</span>' !!}
                    </div>

                    <div class="flex justify-between items-center text-[10px]">
                        <span class="font-semibold text-gray-500 truncate max-w-[160px]"><i class="fas fa-paperclip text-gray-400 mr-1.5"></i>Berkas Khusus (Opsional)</span>
                        {!! $pengajuan->dokumen && $pengajuan->dokumen->file_pendukung_opsional ? '<a href="'.asset('storage/'.$pengajuan->dokumen->file_pendukung_opsional).'" target="_blank" class="px-2 py-0.5 bg-gray-100 border border-gray-300 text-gray-700 font-bold rounded hover:bg-gray-200 transition text-[8px]">LIHAT</a>' : '<span class="text-[8px] text-gray-400 italic">-</span>' !!}
                    </div>
                </div>
            </div>

            <div class="mt-auto">
                <a href="{{ route('user.upload', $pengajuan->id) }}" class="block w-full py-2.5 bg-[#2A65EA] text-white font-bold text-center rounded-xl text-xs hover:bg-blue-700 transition tracking-wide shadow-md">
                    PERBAIKI DOKUMEN
                </a>
            </div>
        </div>

    </div>
</body>
</html>