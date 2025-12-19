<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPendapatan = Payment::where('status', 'paid')->sum('amount');

        $pendapatanPerBulan = Payment::select(
            DB::raw('sum(amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            ->where('status', 'paid')
            ->groupBy('months')
            ->get();

        return view('bendahara.laporan.index', compact('totalPendapatan', 'pendapatanPerBulan'));
    }
}
