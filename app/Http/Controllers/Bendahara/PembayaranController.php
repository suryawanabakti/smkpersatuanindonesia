<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Exports\PaymentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('user')->latest();

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
            $query->whereHas('user.pendaftaran', function ($q) use ($request) {
                $q->where('jurusan_pilihan', $request->jurusan);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $payments = $query->get(); // Or paginate if specificed
        return view('bendahara.pembayaran.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('bendahara.pembayaran.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,expired',
        ]);

        $payment->update(['status' => $request->status]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $filters = $request->only(['search', 'jurusan', 'status', 'start_date', 'end_date']);
        $filename = 'laporan-pembayaran-' . date('Y-m-d-His') . '.xlsx';

        return Excel::download(new PaymentExport($filters), $filename);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:payments,id',
        ]);

        Payment::whereIn('id', $request->ids)->delete();

        return back()->with('success', 'Pembayaran terpilih berhasil dihapus.');
    }
}
