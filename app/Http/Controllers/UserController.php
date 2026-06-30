<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Halaman awal untuk mengisi form pengajuan
    public function showPengajuan()
    {
        return view('user.pengajuan');
    }

    // Memproses data awal pengajuan
    public function processPengajuan(Request $request)
    {
        $request->validate([
            'nomor_hak_tanah'    => 'required|string',
            'lokasi_tanah'       => 'required|string',
            'luas_tanah'         => 'required|numeric|min:1',
            'tahun_pembangunan'  => 'required|integer|min:1900|max:' . (date('Y') + 5),
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

    // Halaman untuk upload dokumen
    public function showUpload($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        return view('user.upload', ['pengajuan_id' => $id, 'pengajuan' => $pengajuan]);
    }

    // Memproses upload dokumen (Cicil Upload)
    public function processUpload(Request $request, $id)
    {
        $request->validate([
            'file_ktp'              => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_sertifikat'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_spt_pbb'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_pernyataan_3in1'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:5120',
            'file_gambar_bangunan'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_pendukung_opsional'=> 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $dokumen = Dokumen::firstOrNew(['pengajuan_id' => $id]);

            $fields = [
                'file_ktp', 'file_sertifikat', 'file_spt_pbb', 
                'file_pernyataan_3in1', 'file_gambar_bangunan', 'file_pendukung_opsional'
            ];

            foreach ($fields as $field) {
                if ($request->hasFile($field)) {
                    if ($dokumen->$field) {
                        Storage::disk('public')->delete($dokumen->$field);
                    }
                    $dokumen->$field = $request->file($field)->store('dokumen', 'public');
                }
            }

            $dokumen->save();

            // Cek kelengkapan dokumen untuk update status
            $wajib = ['file_ktp', 'file_sertifikat', 'file_spt_pbb', 'file_pernyataan_3in1', 'file_gambar_bangunan'];
            $lengkap = true;
            foreach($wajib as $w) { if(empty($dokumen->$w)) $lengkap = false; }
            
            Pengajuan::where('id', $id)->update(['status' => $lengkap ? 'MENUNGGU' : 'PERLU PERBAIKAN']);

            DB::commit();
            return redirect()->back()->with('success', 'Dokumen berhasil disimpan sementara.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal mengupload: ' . $e->getMessage()]);
        }
    }

    // Fungsi untuk menampilkan dokumen (diperbaiki agar Admin bisa akses)
    public function lihatDokumen($id, $field)
    {
        $dokumen = Dokumen::where('pengajuan_id', $id)->firstOrFail();
        $pengajuan = Pengajuan::findOrFail($id);

        // IZINKAN jika dia Pemilik Dokumen ATAU jika dia adalah Admin
        // Kita cek role user yang sedang login
        if ($pengajuan->user_id !== Auth::id() && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        $path = $dokumen->$field;
        if (!$path || !Storage::disk('public')->exists($path)) {
            return back()->withErrors(['error' => 'File tidak ditemukan.']);
        }

        return Storage::disk('public')->response($path);
    }

    // Menampilkan detail pengajuan
    public function detailPengajuan($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
        return view('user.detail', compact('pengajuan'));
    }

    // Status pengajuan terkini
    public function statusPengajuan($id = null)
    {
        // Jika $id tidak ada, ambil pengajuan terbaru
        if ($id) {
            $pengajuan = \App\Models\Pengajuan::findOrFail($id);
        } else {
            $pengajuan = \App\Models\Pengajuan::where('user_id', auth()->id())
                        ->latest()
                        ->first();
        }

        // Pastikan variabel 'pengajuan' dikirim dengan menggunakan compact('pengajuan')
        return view('user.status', compact('pengajuan'));
    }

    public function showPanduan()
    {
        $faqs = \App\Models\Faq::all(); // Ambil data FAQ dari database
        return view('user.panduan', compact('faqs'));
    }

    // Riwayat pengajuan
    public function riwayatPengajuan(Request $request)
    {
        $userId = auth()->id();
        $query = Pengajuan::where('user_id', $userId);
        $judul = 'Riwayat Pengajuan';

        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status);
            $judul = 'Riwayat ' . ucfirst(strtolower($status));
        }

        $daftarPengajuan = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('user.riwayat', compact('daftarPengajuan', 'judul'));
    }

    public function showProfil()
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();
        return view('user.profil', compact('user'));
    }
}