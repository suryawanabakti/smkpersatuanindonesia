 <x-app-layout>
    @section('header', 'Proses Pembayaran')

    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
            
            @if ($payment->status == 'success' || $payment->status == 'paid')
            <div class="mb-6 flex justify-center">
                <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil</h2>
            <p class="text-gray-500 mb-8">Terima kasih, pembayaran Anda telah kami terima.</p>
            @else
            <div class="mb-6 flex justify-center">
                <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Pembayaran</h2>
            <p class="text-gray-500 mb-8">Silakan selesaikan pembayaran Anda.</p>
            @endif

            <div class="space-y-4 mb-8 text-left bg-gray-50 p-6 rounded-xl">
                <div class="flex justify-between">
                    <span class="text-gray-600">Order ID:</span>
                    <span class="font-semibold text-gray-900">{{ $payment->order_id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Keterangan:</span>
                    <span class="font-semibold text-gray-900">{{ $payment->description }}</span>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-4 mt-2">
                    <span class="text-lg font-bold text-gray-800">Total Tagihan:</span>
                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($payment->status == 'success' || $payment->status == 'paid')
            <a href="{{ route('student.payment.print', $payment->id) }}" target="_blank" class="w-full block text-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-xl shadow-green-600/20 transform transition-all hover:-translate-y-0.5 text-lg mb-4">
                Cetak Bukti Pembayaran
            </a>
            @else
            <button id="pay-button" class="w-full px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-xl shadow-blue-600/20 transform transition-all hover:-translate-y-0.5 text-lg mb-4">
                Bayar Sekarang
            </button>
            <form action="{{ route('student.payment.cancel', $payment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-8 py-3 bg-white border border-red-200 text-red-600 hover:bg-red-50 font-medium rounded-xl transition-colors">
                    Batalkan Pembayaran
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Midtrans Snap Script -->
    <!-- Midtrans Snap Script -->
    @if ($payment->status == 'pending')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('{{ $payment->snap_token }}', {
                // Optional
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    alert("pembayaran berhasil!"); 
                    console.log(result);
                    window.location.href = "{{ route('student.payment.success', $payment->id) }}";
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        };
    </script>
    @endif
</x-app-layout>
