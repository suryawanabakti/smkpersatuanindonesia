<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold mb-4">Informasi Pembayaran</h3>
                            <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                            <p><strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <p><strong>Status:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-800">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </p>
                            <p><strong>Tanggal Dibuat:</strong> {{ $payment->created_at->format('d M Y H:i') }}</p>
                            @if($payment->payment_type)
                                <p><strong>Tipe Pembayaran:</strong> {{ $payment->payment_type }}</p>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4">Informasi Siswa</h3>
                            <p><strong>Nama:</strong> {{ $payment->user?->name ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $payment->user?->email ?? 'N/A' }}</p>
                            
                            <div class="mt-6">
                                <a href="{{ route('bendahara.pembayaran.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
