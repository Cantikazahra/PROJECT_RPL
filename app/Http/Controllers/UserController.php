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
            'status'             => 'perlu_perbaikan',
            'tanggal_pengajuan'  => date('Y-m-d')
        ]);

        return redirect()->route('user.upload', $pengajuan->id);
    }

    public function showUpload($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        return view('user.upload', ['pengajuan_id' => $id, 'pengajuan' => $pengajuan]);
    }

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

            $wajib = ['file_ktp', 'file_sertifikat', 'file_spt_pbb', 'file_pernyataan_3in1', 'file_gambar_bangunan'];
            $lengkap = true;
            foreach($wajib as $w) { if(empty($dokumen->$w)) $lengkap = false; }
            
            Pengajuan::where('id', $id)->update(['status' => $lengkap ? 'menunggu' : 'perlu_perbaikan']);

            DB::commit();
            return redirect()->back()->with('success', 'Dokumen berhasil disimpan sementara.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal mengupload: ' . $e->getMessage()]);
        }
    }

    public function lihatDokumen($id, $field)
    {
        $dokumen = Dokumen::where('pengajuan_id', $id)->firstOrFail();
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->user_id !== Auth::id() && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        $path = $dokumen->$field;
        if (!$path || !Storage::disk('public')->exists($path)) {
            return back()->withErrors(['error' => 'File tidak ditemukan.']);
        }

        return Storage::disk('public')->response($path);
    }

    public function detailPengajuan($id)
    {
        $pengajuan = Pengajuan::with('dokumen')->findOrFail($id);
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
        return view('user.detail', compact('pengajuan'));
    }

    public function statusPengajuan($id = null)
    {
        if ($id) {
            $pengajuan = \App\Models\Pengajuan::findOrFail($id);
        } else {
            $pengajuan = \App\Models\Pengajuan::where('user_id', auth()->id())
                        ->latest()
                        ->first();
        }

        return view('user.status', compact('pengajuan'));
    }

    public function showPanduan()
    {
        $faqs = \App\Models\Faq::all();
        return view('user.panduan', compact('faqs'));
    }

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
        $user = auth()->user();
        return view('user.profil', compact('user'));
    }

    public function showEditProfil() {
        return view('user.edit_profil'); // Pastikan path filenya sesuai
    }

    public function updateProfil(Request $request) {
        $user = auth()->user();
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        $user->nama = $request->nama;
        $user->alamat = $request->alamat;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.profil')->with('success', 'Profil berhasil diupdate!');
    }
}