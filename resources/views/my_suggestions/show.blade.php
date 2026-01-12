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
                            {{ $suggestion->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Sudah Dibaca
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-6 py-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-sm">
                            {{ substr($suggestion->sender->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Dari: {{ $suggestion->sender->name }}</p>
                            <p class="text-xs text-gray-500">Kepala Sekolah</p>
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-100">
                        {!! nl2br(e($suggestion->message)) !!}
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <a href="{{ route('my_suggestions.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        &larr; Kembali ke Daftar Saran
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
