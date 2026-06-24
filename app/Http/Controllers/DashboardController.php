<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil hitungan ringkasan data statistik
        $total = Pengajuan::where('user_id', $userId)->count();
        $menunggu = Pengajuan::where('user_id', $userId)->where('status', 'MENUNGGU')->count();
        $disetujui = Pengajuan::where('user_id', $userId)->where('status', 'DISETUJUI')->count();

        // Ambil data pengajuan paling terbaru
        $latest = Pengajuan::where('user_id', $userId)->latest()->first();

        return view('user.dashboard', compact('total', 'menunggu', 'disetujui', 'latest'));
    }
}