<x-app-layout>
    @section('header', 'Detail Saran')

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <!-- Header -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            {{ $suggestion->title }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Dikirim pada {{ $suggestion->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                         @if($suggestion->is_read)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Sudah Dibaca
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Belum Dibaca
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Content -->
                <div class="px-6 py-6">
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($suggestion->message)) !!}
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-gray-500 mr-2">Penerima:</span>
                                @if($suggestion->recipient)
                                    <div class="flex items-center">
                                         <div class="flex-shrink-0 h-6 w-6 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-xs mr-2">
                                            {{ substr($suggestion->recipient->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">{{ $suggestion->recipient->name }} ({{ ucfirst($suggestion->recipient_role) }})</span>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Peran: {{ ucfirst($suggestion->recipient_role) }}
                                    </span>
                                @endif
                            </div>
                            
                            @if($suggestion->sender_id == Auth::id())
                                <div class="flex space-x-3">
                                    <a href="{{ route('kepala_sekolah.suggestions.edit', $suggestion) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Edit</a>
                                    <form action="{{ route('kepala_sekolah.suggestions.destroy', $suggestion) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus saran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <a href="{{ url()->previous() == url()->current() ? route('kepala_sekolah.suggestions.index') : url()->previous() }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        &larr; Kembali ke Daftar Saran
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
