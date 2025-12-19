<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('panitia pddb')) {
            return $this->panitiaDashboard();
        }

        if ($user->hasRole('bendahara')) {
            return $this->bendaharaDashboard();
        }

        if ($user->hasRole('student') || $user->pendaftaranSiswa) {
            return redirect()->route('student.dashboard');
        }

        return view('dashboard');
    }

    private function panitiaDashboard()
    {
        $totalSiswa = PendaftaranSiswa::count();
        $totalDiterima = PendaftaranSiswa::where('status', 'diterima')->count();
        $totalDitolak = PendaftaranSiswa::where('status', 'ditolak')->count();
        $totalPending = PendaftaranSiswa::where('status', 'pending')->count();
        $recentSiswa = PendaftaranSiswa::latest()->take(5)->get();

        return view('panitia.dashboard', compact('totalSiswa', 'totalDiterima', 'totalDitolak', 'totalPending', 'recentSiswa'));
    }

    private function bendaharaDashboard()
    {
        $totalPendapatan = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        $recentPayments = Payment::with('user')->latest()->take(5)->get();

        return view('bendahara.dashboard', compact('totalPendapatan', 'pendingPayments', 'recentPayments'));
    }
}
