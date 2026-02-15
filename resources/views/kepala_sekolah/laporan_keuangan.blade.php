<x-app-layout>
    @section('header', 'Laporan Keuangan')

    <div class="space-y-6">
        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pembayaran Berhasil</p>
                        <p class="text-2xl font-bold text-green-600">{{ $totalSuccess }}</p>
                    </div>
                    <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pembayaran Pending</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $totalPending }}</p>
                    </div>
                    <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pembayaran Gagal</p>
                        <p class="text-2xl font-bold text-red-600">{{ $totalFailed }}</p>
                    </div>
                    <div class="h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Export -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full flex items-center">
            <form method="GET" action="{{ route('kepala_sekolah.laporan_keuangan.index') }}"
                class="flex flex-col gap-2">

                {{-- Label --}}
                <label for="year" class="text-sm font-semibold text-gray-700">
                    Filter Tahun Pendaftaran
                </label>

                {{-- Select + Button --}}
                <div class="flex items-center gap-2">

                    {{-- Tahun --}}
                    <select name="year" id="year"
                        class="rounded-xl border-gray-200 text-gray-700
                           focus:ring-indigo-500 focus:border-indigo-500
                           min-w-[140px]">
                        <option value="">Semua Tahun</option>
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Filter Button --}}
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-xl
                           hover:bg-indigo-700 transition-colors shadow-sm">
                        Filter
                    </button>

                    {{-- Reset Button --}}
                    @if (request()->has('year'))
                        <a href="{{ route('kepala_sekolah.laporan_keuangan.index') }}"
                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl
                          hover:bg-gray-200 transition-colors shadow-sm">
                            Reset
                        </a>
                    @endif

                </div>
            </form>
        </div>



        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($payments as $payment)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $payment->order_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $payment->user?->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $payment->user?->pendaftaran?->jurusan_pilihan ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'pending' ? 'yellow' : 'red') }}-800">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $payment->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Tidak ada data pembayaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4 p-4 bg-gray-50/50">
                @forelse($payments as $payment)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Order
                                    #{{ $payment->order_id }}</h4>
                                <h3 class="text-base font-bold text-gray-900 mt-1">
                                    {{ $payment->user?->name ?? 'N/A' }}</h3>
                            </div>
                            <span
                                class="px-2 py-1 text-[10px] uppercase font-bold rounded-lg bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'pending' ? 'yellow' : 'red') }}-800">
                                {{ $payment->status }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Jurusan</span>
                                <span
                                    class="text-xs font-bold text-gray-900">{{ $payment->user?->pendaftaran?->jurusan_pilihan ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">Tanggal</span>
                                <span
                                    class="text-xs font-medium text-gray-700">{{ $payment->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                                <span class="text-sm font-bold text-gray-900">Total</span>
                                <span class="text-lg font-black text-indigo-600">Rp
                                    {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-gray-200">
                        <p class="text-sm text-gray-500">Tidak ada data pembayaran</p>
                    </div>
                @endforelse
            </div>

            @if ($payments->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
