<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())->latest()->get();
        return view('student.payment.index', compact('payments'));
    }

    public function create()
    {
        return view('student.payment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $orderId = 'SPP-' . Str::random(10);

        $payment = Payment::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        try {
            $midtrans = new MidtransService();
            $snapToken = $midtrans->getSnapToken($params);

            $payment->update(['snap_token' => $snapToken]);

            return redirect()->route('student.payment.show', $payment->id);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $payment = Payment::where('user_id', Auth::id())->findOrFail($id);
        return view('student.payment.show', compact('payment'));
    }

    // Webhook implementation would go here, but omitted for now as it requires public URL
}
