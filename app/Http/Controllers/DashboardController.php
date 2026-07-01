<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $userId = Auth::id();
        $total = Pengajuan::where('user_id', $userId)->count();
        $menunggu = Pengajuan::where('user_id', $userId)->where('status', 'menunggu')->count();
        $disetujui = Pengajuan::where('user_id', $userId)->where('status', 'disetujui')->count();

        $latest = Pengajuan::where('user_id', $userId)->latest()->first();

        return view('user.dashboard', compact('total', 'menunggu', 'disetujui', 'latest'));
    }
}