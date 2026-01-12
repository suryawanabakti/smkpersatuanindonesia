<x-app-layout>
    @section('header', 'Dashboard')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Total Pendapatan</div>
                    <div class="text-3xl text-green-600 font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Menunggu Verifikasi</div>
                    <div class="text-3xl text-orange-600 font-bold">{{ $pendingPayments }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Pembayaran Terbaru</h3>
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentPayments as $payment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $payment->user?->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->user?->pendaftaran?->jurusan_pilihan ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-800">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('bendahara.pembayaran.show', $payment) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="block md:hidden space-y-4">
                        @foreach ($recentPayments as $payment)
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex flex-col gap-3">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 truncate">{{ $payment->user?->name ?? 'N/A' }}</h4>
                                        <p class="text-[10px] text-gray-500 mt-0.5">{{ $payment->user?->pendaftaran?->jurusan_pilihan ?? 'N/A' }}</p>
                                    </div>
                                    <span class="px-2 py-0.5 text-[9px] uppercase font-black rounded bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-800">
                                        {{ $payment->status }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-2 border-t border-gray-100/50">
                                    <div class="text-[10px] text-gray-400 font-medium">
                                        {{ $payment->created_at->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs font-black text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                        <a href="{{ route('bendahara.pembayaran.show', $payment) }}" class="text-indigo-600 text-xs font-bold bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100 transition-all active:scale-95">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                     <div class="mt-4 text-right">
                        <a href="{{ route('bendahara.pembayaran.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
