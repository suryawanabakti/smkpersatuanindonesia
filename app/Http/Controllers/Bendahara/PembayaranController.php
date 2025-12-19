<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->latest()->get();
        return view('bendahara.pembayaran.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('bendahara.pembayaran.show', compact('payment'));
    }
}
