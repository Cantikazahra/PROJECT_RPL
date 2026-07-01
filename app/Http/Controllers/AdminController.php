<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        if ($user->role !== 'admin') {
            return back()->withErrors([
                'role_error' => 'Halaman ini khusus untuk admin. Pemohon silakan login di halaman pemohon.',
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function index()
    {
        $data = [
            'total' => Pengajuan::count(),
            'menunggu' => Pengajuan::where('status', 'menunggu')->count(),
            'disetujui' => Pengajuan::where('status', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
            'pengajuanTerbaru' => Pengajuan::with('user')->latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('data'));
    }

    public function daftarPengajuan(Request $request)
    {
        $query = Pengajuan::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

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
            'status' => 'required|in:menunggu,disetujui,ditolak,perlu_perbaikan',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::with(['user', 'dokumen'])->findOrFail($id);
        return view('admin.detail', compact('pengajuan'));
    }
}