<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PendaftaranSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('kepala_sekolah')) {
            return redirect()->route('kepala_sekolah.dashboard', $request->all());
        }

        if ($user->hasRole('panitia')) {
            return $this->panitiaDashboard($request);
        }

        if ($user->hasRole('bendahara')) {
            return $this->bendaharaDashboard();
        }

        if ($user->pendaftaran) {
            return redirect()->route('student.dashboard');
        }

        return view('dashboard');
    }

    private function panitiaDashboard(Request $request)
    {
        $selectedYear = $request->get('year', date('Y'));
        $availableYears = PendaftaranSiswa::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($availableYears->isEmpty()) {
            $availableYears = collect([date('Y')]);
        }

        $query = PendaftaranSiswa::whereYear('created_at', $selectedYear);

        $totalSiswa = (clone $query)->count();
        $totalDiterima = (clone $query)->where('status', 'diterima')->count();
        $totalDitolak = (clone $query)->where('status', 'ditolak')->count();
        $totalPending = (clone $query)->where('status', 'pending')->count();
        $recentSiswa = (clone $query)->latest()->take(5)->get();

        return view('panitia.dashboard', compact(
            'totalSiswa',
            'totalDiterima',
            'totalDitolak',
            'totalPending',
            'recentSiswa',
            'availableYears',
            'selectedYear'
        ));
    }

    private function bendaharaDashboard()
    {
        $totalPendapatan = Payment::where('status', 'paid')->sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        $recentPayments = Payment::with('user')->latest()->take(5)->get();

        return view('bendahara.dashboard', compact('totalPendapatan', 'pendingPayments', 'recentPayments'));
    }
}
