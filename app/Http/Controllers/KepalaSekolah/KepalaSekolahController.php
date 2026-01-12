<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
{
    public function index(Request $request)
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

        // Data for Charts
        // 1. Successful Registrations per Major
        $registrationsByMajor = (clone $query)->select('jurusan_pilihan', DB::raw('count(*) as total'))
            ->where('status', 'diterima')
            ->groupBy('jurusan_pilihan')
            ->pluck('total', 'jurusan_pilihan');

        // 2. Student Distribution per Major
        $studentsByMajor = (clone $query)->select('jurusan_pilihan', DB::raw('count(*) as total'))
            ->groupBy('jurusan_pilihan')
            ->pluck('total', 'jurusan_pilihan');

        // 3. Monthly Income
        $monthlyIncome = Payment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->where('status', 'paid')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Process income to ensure all 12 months are present (0 if no data)
        $incomeData = array_fill(1, 12, 0);
        foreach ($monthlyIncome as $income) {
            $incomeData[$income->month] = $income->total;
        }

        // 4. Yearly Registrations per Major (This one stays yearly but we can highlight the selected year)
        $yearlyRegistrations = PendaftaranSiswa::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw("SUM(CASE WHEN jurusan_pilihan = 'TJKT' THEN 1 ELSE 0 END) as tjkt"),
            DB::raw("SUM(CASE WHEN jurusan_pilihan = 'TKRO' THEN 1 ELSE 0 END) as tkro")
        )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $yearlyLabels = $yearlyRegistrations->pluck('year');
        $yearlyTJKT = $yearlyRegistrations->pluck('tjkt');
        $yearlyTKRO = $yearlyRegistrations->pluck('tkro');


        return view('kepala_sekolah.dashboard', compact(
            'totalSiswa',
            'totalDiterima',
            'totalDitolak',
            'totalPending',
            'recentSiswa',
            'registrationsByMajor',
            'studentsByMajor',
            'incomeData',
            'yearlyLabels',
            'yearlyTJKT',
            'yearlyTKRO',
            'availableYears',
            'selectedYear'
        ));
    }
}
