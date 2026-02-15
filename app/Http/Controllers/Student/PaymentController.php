<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SchoolInformation;
use App\Services\MidtransService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $whatsappService;
    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->pendaftaran;
        if (!$siswa->status_konfirmasi || $siswa->status !== 'diterima') {
            return redirect()->route('student.dashboard')->with('error', 'Proses pembayaran boleh dilakukan ketika berkas yang di unggah siswa itu sudah dicek dan divalidasi oleh panitia .');
        }

        $payments = Payment::where('user_id', $user->id)->latest()->get();

        return view('student.payment.index', compact('payments'));
    }

    public function create()
    {
        $schoolInformation = SchoolInformation::first();
        return view('student.payment.create', compact('schoolInformation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:255',
            'attributes' => 'required|array',
        ]);

        $user = Auth::user();
        $orderId = 'PPDB-' . Str::random(10);

        $data = [
            'user_id' => $user->id,
            'order_id' => $orderId,
            'amount' => $request->amount,
            'status' => 'pending',
            'description' => $request->description,
        ];

        // Map attributes from array to boolean columns
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attr) {
                if (in_array($attr, ['topi', 'dasi', 'baju', 'batik', 'baju_olahraga'])) {
                    $data[$attr] = true;
                }
            }
        }

        $payment = Payment::create($data);

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
            $midtrans = new MidtransService;
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

    public function print($id)
    {
        $payment = Payment::where('user_id', Auth::id())->findOrFail($id);

        return view('student.payment.print', compact('payment'));
    }

    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash('sha512', $notification->order_id . $notification->status_code . $notification->gross_amount . config('midtrans.server_key'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $notification->transaction_status;
        $payment = Payment::where('order_id', $notification->order_id)->first();

        if (! $payment) {
            return response(['message' => 'Payment not found'], 404);
        }

        if ($transactionStatus == 'capture') {
            if ($notification->fraud_status == 'accept') {
                $payment->update(['status' => 'paid']);
            }
        } elseif ($transactionStatus == 'settlement') {
            $payment->update(['status' => 'paid']);
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $payment->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'pending') {
            $payment->update(['status' => 'pending']);
        }

        return response(['message' => 'Notification processed'], 200);
    }

    public function success($id)
    {
        $payment = Payment::where('user_id', Auth::id())->findOrFail($id);
        $payment->update(['status' => 'paid']); // Or 'success' based on your enum
        // Optional: Send WhatsApp Notification here as well since webhook might be skipped locally
        $user = Auth::user();
        $siswa = $user->pendaftaran;
        $siswa->update(['status' => 'diterima']);
        if ($siswa->no_hp_orang_tua) {
            $message = 'Pembayaran Atribut Anda sebesar Rp ' . number_format($payment->amount, 0, ',', '.') . ' telah berhasil. Terima kasih.';
            $this->whatsappService->send($siswa->no_hp_orang_tua, $message);
        }

        return redirect()->route('student.payment.show', $payment->id)->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function cancel(Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        if ($payment->status !== 'pending') {
            return back()->with('error', 'Hanya pembayaran dengan status pending yang dapat dibatalkan.');
        }

        $payment->delete();

        return redirect()->route('student.payment.index')->with('success', 'Pembayaran berhasil dibatalkan.');
    }
}
