<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Exports\PaymentExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('user.pendaftaran')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('jurusan')) {
            $jurusan = $request->jurusan;
            $query->whereHas('user.pendaftaran', function ($q) use ($jurusan) {
                $q->where('jurusan_pilihan', $jurusan);
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $payments = $query->paginate(15);

        // Statistics
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $totalPending = Payment::where('status', 'pending')->count();
        $totalSuccess = Payment::where('status', 'paid')->count();
        $totalFailed = Payment::where('status', 'failed')->count();

        return view('kepala_sekolah.laporan_keuangan', compact(
            'payments',
            'totalRevenue',
            'totalPending',
            'totalSuccess',
            'totalFailed'
        ));
    }

    public function export(Request $request)
    {
        $filters = $request->only(['status', 'search', 'jurusan', 'date_from', 'date_to']);
        // Normalize for PaymentExport
        $filters['start_date'] = $request->date_from;
        $filters['end_date'] = $request->date_to;

        $filename = 'laporan-keuangan-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new PaymentExport($filters), $filename);
    }
}
