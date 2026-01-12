<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use App\Exports\PpdbExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranSiswa::query();

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name or NISN
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter by jurusan
        if ($request->filled('jurusan')) {
            $query->where('jurusan_pilihan', $request->jurusan);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $siswas = $query->latest()->paginate(15);

        // Statistics (filtered by year if provided)
        $statsQuery = PendaftaranSiswa::query();
        if ($request->filled('year')) {
            $statsQuery->whereYear('created_at', $request->year);
        }

        $totalSiswa = (clone $statsQuery)->count();
        $totalDiterima = (clone $statsQuery)->where('status', 'diterima')->count();
        $totalDitolak = (clone $statsQuery)->where('status', 'ditolak')->count();
        $totalPending = (clone $statsQuery)->where('status', 'pending')->count();

        // Get unique years for filter
        $availableYears = PendaftaranSiswa::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Get unique jurusan for filter dropdown
        $jurusanList = PendaftaranSiswa::select('jurusan_pilihan')
            ->distinct()
            ->whereNotNull('jurusan_pilihan')
            ->pluck('jurusan_pilihan');

        return view('kepala_sekolah.laporan_ppdb', compact(
            'siswas',
            'totalSiswa',
            'totalDiterima',
            'totalDitolak',
            'totalPending',
            'jurusanList',
            'availableYears'
        ));
    }

    public function export(Request $request)
    {
        $filters = $request->only(['status', 'search', 'jurusan', 'date_from', 'date_to']);

        $filename = 'laporan-ppdb-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new PpdbExport($filters), $filename);
    }
}
