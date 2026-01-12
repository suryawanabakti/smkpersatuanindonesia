<x-app-layout>
    @section('header', 'Edit Saran')

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-100">
                    <form action="{{ route('kepala_sekolah.suggestions.update', $suggestion) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Recipient Info (Read Only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penerima</label>
                            <div class="px-3 py-2 bg-gray-100 rounded-md border border-gray-200 text-gray-600 text-sm">
                                @if($suggestion->recipient)
                                    {{ $suggestion->recipient->name }} ({{ ucfirst($suggestion->recipient_role) }})
                                @else
                                    Semua {{ ucfirst($suggestion->recipient_role) }}
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Penerima tidak dapat diubah.</p>
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Saran</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('title', $suggestion->title) }}" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Isi Saran</label>
                            <textarea name="message" id="message" rows="6" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required>{{ old('message', $suggestion->message) }}</textarea>
                            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end pt-4 border-t border-gray-100">
                            <a href="{{ route('kepala_sekolah.suggestions.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
