<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'total' => Pengajuan::count(),
            'menunggu' => Pengajuan::where('status', 'menunggu')->count(),
            'disetujui' => Pengajuan::where('status', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
            // Menggunakan with('user') untuk performa yang lebih baik
            'pengajuanTerbaru' => Pengajuan::with('user')->latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('data'));
    }

    public function daftarPengajuan(Request $request)
    {
        // 1. Tambahkan ->with('user') di sini agar nama pemohon tampil
        $query = Pengajuan::with('user');

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian: bisa cari berdasarkan no_pengajuan ATAU nama pemohon
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_pengajuan', 'like', "%{$search}%")
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $pengajuans = $query->latest()->paginate(10)->withQueryString();
        
        return view('admin.pengajuan', compact('pengajuans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update([
            'status' => $request->status,
            'catatan_petugas' => $request->catatan,
        ]);

        return back()->with('success', 'Status pengajuan berhasil diupdate.');
    }

    public function detail($id)
    {
        // Mengambil data pengajuan beserta user dan dokumennya
        $pengajuan = \App\Models\Pengajuan::with(['user', 'dokumen'])->findOrFail($id);
        return view('admin.detail', compact('pengajuan'));
    }
}