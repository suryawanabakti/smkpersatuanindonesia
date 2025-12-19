<x-app-layout>
    @section('header', 'Dashboard Siswa')

    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
            <div class="p-6 bg-white border-b border-gray-100">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Status Pendaftaran</h3>
                <div class="mt-4 flex items-center">
                    @if($pendaftaran)
                        <span class="px-4 py-2 rounded-full text-sm font-semibold 
                            {{ $pendaftaran->status == 'diterima' ? 'bg-green-100 text-green-800' : 
                               ($pendaftaran->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($pendaftaran->status) }}
                        </span>
                        <div class="ml-4 text-gray-600">
                            Jurusan Pilihan: <span class="font-semibold">{{ $pendaftaran->jurusan_pilihan }}</span>
                        </div>
                    @else
                        <span class="text-gray-500 italic">Belum ada data pendaftaran.</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Latest Payment -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Pembayaran Terakhir</h3>
                @if($latestPayment)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $latestPayment->description }}</p>
                            <p class="text-sm text-gray-500">{{ $latestPayment->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-900">Rp {{ number_format($latestPayment->amount, 0, ',', '.') }}</p>
                            <span class="text-xs px-2 py-1 rounded {{ $latestPayment->status == 'success' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                {{ ucfirst($latestPayment->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('student.payment.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">Lihat Semua Riwayat &rarr;</a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada riwayat pembayaran.</p>
                    <div class="mt-4 text-center">
                        <a href="{{ route('student.payment.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Bayar SPP Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
