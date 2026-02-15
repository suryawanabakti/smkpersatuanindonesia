<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('panitia.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors" value="{{ old('title', $article->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="category" id="category" class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                    <option value="Berita" {{ $article->category == 'Berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="Pengumuman" {{ $article->category == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    <option value="Kegiatan" {{ $article->category == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                    <option value="Tips & Trik" {{ $article->category == 'Tips & Trik' ? 'selected' : '' }}>Tips & Trik</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                    <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Cover</label>
                            @if($article->image)
                                <div class="mb-2">
                                    <img src="{{ $article->imageUrl }}" alt="Current Image" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors" required>{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('panitia.articles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    toolbar: {
                     items: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        // Tambahkan 'alignment' di sini
                        'alignment', '|', 
                        'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ]
                    },
                       alignment: {
                options: [ 'left', 'center', 'right', 'justify' ]
            },
                    simpleUpload: {
                        uploadUrl: "{{ route('panitia.articles.upload') }}",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
        <style>
            .ck-content .text-align-left { text-align: left; }
        .ck-content .text-align-center { text-align: center; }
        .ck-content .text-align-right { text-align: right; }
        .ck-content .text-align-justify { text-align: justify; }
            .ck-editor__editable_inline {
                min-height: 400px;
                border-bottom-left-radius: 12px !important;
                border-bottom-right-radius: 12px !important;
            }
            .ck-editor__top {
                border-top-left-radius: 12px !important;
                border-top-right-radius: 12px !important;
            }
            /* Fix List and Heading Styles in CKEditor */
            .ck-content ul {
                list-style-type: disc !important;
                padding-left: 1.5rem !important;
                display: block !important;
            }
            .ck-content ol {
                list-style-type: decimal !important;
                padding-left: 1.5rem !important;
                display: block !important;
            }
            .ck-content li {
                display: list-item !important;
            }
            .ck-content h2 {
                font-size: 2em !important;
                font-weight: bold !important;
                margin-top: 1em !important;
                margin-bottom: 0.5em !important;
                display: block !important;
            }
            .ck-content h3 {
                font-size: 1.5em !important;
                font-weight: bold !important;
                margin-top: 1em !important;
                margin-bottom: 0.5em !important;
                display: block !important;
            }
            .ck-content h4 {
                font-size: 1.2em !important;
                font-weight: bold !important;
                margin-top: 1em !important;
                margin-bottom: 0.5em !important;
                display: block !important;
            }
        </style>
    @endpush
</x-app-layout>
