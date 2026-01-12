<x-app-layout>
    @section('header', 'Pembayaran')

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Pembayaran</h2>
            <a href="{{ route('student.payment.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium shadow-sm transition-colors">
                + Bayar 
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->order_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $payment->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($payment->status == 'success' || $payment->status === 'paid' )
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Berhasil</span>
                                    @elseif($payment->status == 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ $payment->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        @if($payment->status == 'pending')
                                            <a href="{{ route('student.payment.show', $payment->id) }}" class="text-indigo-600 hover:text-indigo-900">Bayar</a>
                                            <form action="{{ route('student.payment.cancel', $payment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Batalkan</button>
                                            </form>
                                        @else
                                            <a href="{{ route('student.payment.show', $payment->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada riwayat pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4 p-4 bg-gray-50">
                @forelse($payments as $payment)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-base font-bold text-gray-900">{{ $payment->description }}</h4>
                                <p class="text-xs text-gray-500 mt-1">Order ID: {{ $payment->order_id }}</p>
                            </div>
                            @if($payment->status == 'success' || $payment->status === 'paid' )
                                <span class="px-2 py-1 text-[10px] uppercase tracking-wider font-bold rounded-lg bg-green-100 text-green-800">Berhasil</span>
                            @elseif($payment->status == 'pending')
                                <span class="px-2 py-1 text-[10px] uppercase tracking-wider font-bold rounded-lg bg-yellow-100 text-yellow-800">Menunggu</span>
                            @else
                                <span class="px-2 py-1 text-[10px] uppercase tracking-wider font-bold rounded-lg bg-red-100 text-red-800">{{ $payment->status }}</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-indigo-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $payment->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-gray-50 gap-2">
                            @if($payment->status == 'pending')
                                <a href="{{ route('student.payment.show', $payment->id) }}" 
                                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold hover:bg-indigo-700 transition-colors">
                                    Bayar Sekarang
                                </a>
                                <form action="{{ route('student.payment.cancel', $payment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('student.payment.show', $payment->id) }}" 
                                   class="px-4 py-2 bg-gray-50 text-gray-600 rounded-lg text-xs font-bold hover:bg-gray-100 transition-colors">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-sm text-gray-500 bg-white rounded-2xl border border-dashed border-gray-200">
                        Belum ada riwayat pembayaran.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
