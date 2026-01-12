<x-app-layout>
    @section('header', 'Dashboard Siswa')

    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
            <div class="p-6 bg-white border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Status Pendaftaran</h3>
                    @if($pendaftaran && $pendaftaran->status_konfirmasi)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Berkas Dikonfirmasi Panitia
                        </span>
                    @endif
                </div>
                
                <div class="mt-6 flex items-center">
                    @if($pendaftaran)
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-4">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold 
                                    {{ $pendaftaran->status == 'diterima' ? 'bg-green-100 text-green-800' : 
                                       ($pendaftaran->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($pendaftaran->status) }}
                                </span>
                                <div class="text-sm text-gray-600">
                                    No. Pendaftaran: <span class="font-bold text-gray-900">{{ $pendaftaran->no_pendaftaran }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    Jurusan: <span class="font-bold text-gray-900">{{ $pendaftaran->jurusan_pilihan }}</span>
                                </div>
                            </div>
                            
                            @if($pendaftaran->status == 'pending')
                                <p class="mt-4 text-sm text-gray-500">
                                    Berkas Anda sedang dalam proses verifikasi oleh panitia. Mohon cek secara berkala.
                                </p>
                            @elseif($pendaftaran->status == 'diterima')
                                <p class="mt-4 text-sm text-green-600 font-medium">
                                    Selamat! Pendaftaran Anda telah diterima. Silakan lanjutkan ke tahap pembayaran daftar ulang.
                                </p>
                            @endif
                        </div>
                        
                        <div class="ml-auto">
                            <a href="{{ route('student.formulir.edit') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                Lihat / Edit Data Pendaftaran &rarr;
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4 w-full">
                            <p class="text-gray-500 italic mb-4">Belum ada data pendaftaran.</p>
                            <a href="{{ route('student.formulir.edit') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                Isi Formulir Pendaftaran
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SPP Info Card -->
        @if($sppInfo)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informasi Pembayaran SPP ({{ $sppInfo->jurusan }})</h3>
                    <div class="bg-indigo-50 rounded-lg p-5 border border-indigo-100">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold text-indigo-500 uppercase tracking-wider mb-1">Nominal Pembayaran</p>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($sppInfo->amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex-1 sm:ml-8 sm:border-l sm:border-indigo-200 sm:pl-8">
                                <p class="text-xs font-semibold text-indigo-500 uppercase tracking-wider mb-1">Keterangan / Instruksi</p>
                                <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">{{ $sppInfo->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
                            Beli Atribut Seragam
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Registered Students Table -->
     
    </div>
</x-app-layout>
