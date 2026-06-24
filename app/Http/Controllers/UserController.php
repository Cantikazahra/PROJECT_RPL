<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showPengajuan()
    {
        return view('user.pengajuan');
    }

    public function processPengajuan(Request $request)
    {
        $request->validate([
            'nomor_hak_tanah'    => 'required|string',
            'lokasi_tanah'       => 'required|string',
            'luas_tanah'         => 'required|numeric|min:1',
            'tahun_pembangunan'  => 'required|integer|min:' . date('Y'),
            'jenis_bangunan'     => 'required|string',
            'tujuan_pembangunan' => 'required|string',
        ]);

        $tahun = date('Y');
        $count = Pengajuan::whereYear('created_at', $tahun)->count() + 1;
        $no_pengajuan = "PG-J-{$tahun}-" . str_pad($count, 5, '0', STR_PAD_LEFT);

        $pengajuan = Pengajuan::create([
            'user_id'            => Auth::id(),
            'no_pengajuan'       => $no_pengajuan,
            'nomor_hak_tanah'    => $request->nomor_hak_tanah, 
            'lokasi_tanah'       => $request->lokasi_tanah,
            'luas_tanah'         => $request->luas_tanah,
            'tahun_pembangunan'  => $request->tahun_pembangunan, 
            'jenis_bangunan'     => $request->jenis_bangunan,
            'tujuan_pembangunan' => $request->tujuan_pembangunan,
            'status'             => 'PERLU PERBAIKAN', 
            'tanggal_pengajuan'  => date('Y-m-d')
        ]);

        return redirect()->route('user.upload', $pengajuan->id);
    }

    public function showUpload($id)
    {
        return view('user.upload', ['pengajuan_id' => $id]);
    }

    public function processUpload(Request $request, $id)
    {
        $request->validate([
            'file_ktp'                => 'required|file|mimes:pdf,jpg,png|max:5120',
            'file_sertifikat'         => 'required|file|mimes:pdf,jpg,png|max:5120',
            'file_spt_pbb'            => 'required|file|mimes:pdf,jpg,png|max:5120',
            'file_pernyataan_3in1'    => 'required|file|mimes:pdf,jpg,png|max:5120',
            'file_gambar_bangunan'    => 'required|file|mimes:pdf,jpg,png|max:5120',
            'file_pendukung_opsional' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $ktpPath         = $request->file('file_ktp')->store('dokumen/ktp', 'public');
        $sertifikatPath  = $request->file('file_sertifikat')->store('dokumen/sertifikat', 'public');
        $sptPbbPath      = $request->file('file_spt_pbb')->store('dokumen/spt_pbb', 'public'); 
        $pernyataanPath  = $request->file('file_pernyataan_3in1')->store('dokumen/pernyataan', 'public'); 

        $gambarPath      = $request->file('file_gambar_bangunan')->store('dokumen/gambar', 'public');

        $opsionalPath = null;
        if ($request->hasFile('file_pendukung_opsional')) {
            $opsionalPath = $request->file('file_pendukung_opsional')->store('dokumen/opsional', 'public');
        }

        Dokumen::create([
            'pengajuan_id'            => $id,
            'file_ktp'                => $ktpPath,
            'file_sertifikat'         => $sertifikatPath,
            'file_spt_pbb'            => $sptPbbPath,     // 🔥 BARU
            'file_pernyataan_3in1'    => $pernyataanPath, // 🔥 BARU
            'file_gambar_bangunan'    => $gambarPath,
            'file_pendukung_opsional' => $opsionalPath,   // 🔥 BARU
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update(['status' => 'MENUNGGU']);

        return redirect()->route('user.dashboard')->with('success', 'Permohonan berhasil dikirim!');
    }

    public function detailPengajuan($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat pengajuan ini.');
        }

        return view('user.detail', compact('pengajuan'));
    }

    public function statusPengajuan()
    {
        $userId = Auth::id();
        $latest = Pengajuan::where('user_id', $userId)->latest()->first();

        return view('user.status', compact('latest'));
    }

    public function riwayatPengajuan(Request $request)
    {
        $userId = auth()->id();
        $query = \DB::table('pengajuans')->where('user_id', $userId);
        $judul = 'Riwayat Pengajuan';

        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status);

            if ($status === 'MENUNGGU') {
                $judul = 'Riwayat Menunggu';
            } elseif ($status === 'DISETUJUI') {
                $judul = 'Riwayat Disetujui';
            }
        }

        $daftarPengajuan = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('user.riwayat', compact('daftarPengajuan', 'judul'));
    }
}