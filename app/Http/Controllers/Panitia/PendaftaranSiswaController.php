<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranSiswa;
use App\Exports\PpdbExport;
use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PendaftaranSiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = PendaftaranSiswa::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }
        if ($request->filled('jurusan')) {
            $query->where('jurusan_pilihan', $request->jurusan);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('konfirmasi')) {
            $query->where('status_konfirmasi', $request->konfirmasi);
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $availableYears = PendaftaranSiswa::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');


        $siswas = $query->get();
        return view('panitia.pendaftaran.index', compact('siswas', 'availableYears'));
    }

    public function show(PendaftaranSiswa $siswa)
    {
        return view('panitia.pendaftaran.show', compact('siswa'));
    }

    public function verify(Request $request, PendaftaranSiswa $siswa)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $siswa->update(['status' => $request->status]);

        return redirect()->route('panitia.pendaftaran.show', $siswa)->with('success', 'Status pendaftaran berhasil diperbarui');
    }

    public function updateStatusKonfirmasi(Request $request, PendaftaranSiswa $siswa)
    {
        $request->validate([
            'status_konfirmasi' => 'required|boolean',
        ]);

        $siswa->update(['status_konfirmasi' => $request->status_konfirmasi]);

        return response()->json(['success' => true, 'message' => 'Status konfirmasi berhasil diperbarui']);
    }

    public function export(Request $request)
    {
        $filters = $request->only(['status', 'search', 'jurusan', 'start_date', 'end_date']);
        // Normalize date filters for PpdbExport which expects date_from/date_to
        $filters['date_from'] = $request->start_date;
        $filters['date_to'] = $request->end_date;

        $filename = 'laporan-ppdb-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new PpdbExport($filters), $filename);
    }

    public function exportPayments(Request $request)
    {
        $filters = $request->only(['search', 'jurusan', 'status', 'start_date', 'end_date']);
        $filename = 'laporan-pembayaran-ppdb-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new PaymentExport($filters), $filename);
    }

    public function destroy(PendaftaranSiswa $siswa)
    {
        DB::transaction(function () use ($siswa) {
            if ($siswa->user) {
                $siswa->user->delete();
            }
            $siswa->delete();
        });

        return back()->with('success', 'Data siswa dan akun terkait berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pendaftaran_siswas,id',
        ]);

        DB::transaction(function () use ($request) {
            $siswas = PendaftaranSiswa::whereIn('id', $request->ids)->get();
            foreach ($siswas as $siswa) {
                if ($siswa->user) {
                    $siswa->user->delete();
                }
                $siswa->delete();
            }
        });

        return back()->with('success', 'Data siswa terpilih berhasil dihapus.');
    }
}
