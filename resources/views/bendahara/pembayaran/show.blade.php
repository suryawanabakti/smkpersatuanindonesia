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
                            @if($payment->description)
                                <p><strong>Keterangan:</strong> {{ $payment->description }}</p>
                            @endif

                            <div class="mt-4">
                                <h4 class="font-bold text-sm mb-2">Atribut yang Dibeli:</h4>
                                <ul class="list-disc list-inside text-sm space-y-1">
                                    @if($payment->topi) <li>Topi</li> @endif
                                    @if($payment->dasi) <li>Dasi</li> @endif
                                    @if($payment->baju) <li>Baju (Seragam)</li> @endif
                                    @if($payment->batik) <li>Batik</li> @endif
                                    @if($payment->baju_olahraga) <li>Baju Olahraga</li> @endif
                                    @if(!$payment->topi && !$payment->dasi && !$payment->baju && !$payment->batik && !$payment->baju_olahraga)
                                        <li class="text-gray-400 italic">Tidak ada atribut dipilih</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4">Informasi Siswa</h3>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                        {{ substr($payment->user?->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $payment->user?->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $payment->user?->email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                
                                @if($payment->user?->pendaftaran)
                                    <div class="border-t border-gray-200 pt-3 mt-3 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">NISN</span>
                                            <span class="font-medium">{{ $payment->user->pendaftaran->nisn }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Jurusan</span>
                                            <span class="font-medium">{{ $payment->user->pendaftaran->jurusan_pilihan }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">No HP</span>
                                            <span class="font-medium">{{ $payment->user->pendaftaran->no_hp }}</span>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-sm text-yellow-600 mt-2">Data pendaftaran belum lengkap.</p>
                                @endif
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('bendahara.pembayaran.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    &larr; Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
