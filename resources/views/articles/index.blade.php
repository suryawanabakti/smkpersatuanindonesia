<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita & Artikel - {{ $schoolInfo->name ?? 'SMK PERSATUAN INDONESIA MAROS' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-lg dark:bg-gray-900/80 dark:shadow-gray-800 border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <a href="{{ route('landing') }}" class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 tracking-tight">
                        SMK Persatuan Indonesia Maros
                    </span>
                </a>
                
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('landing') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Beranda</a>
                    <a href="{{ route('pendaftaran.index') }}"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30">
                        Daftar Sekarang
                    </a>
                </div>

                <a href="{{ route('landing') }}" class="md:hidden p-2 text-gray-700 dark:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">Berita & Artikel</h1>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Tetap terupdate dengan kegiatan, prestasi, dan pengumuman terbaru dari SMK Persatuan Indonesia Maros.
                </p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 lg:p-8 shadow-xl shadow-gray-200/50 dark:shadow-none mb-12 border border-gray-100 dark:border-gray-700">
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Search -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 ml-1">Cari Artikel</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 transition-all text-sm" 
                                    placeholder="Judul atau konten...">
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 ml-1">Kategori</label>
                            <select name="category" class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 transition-all text-sm appearance-none">
                                <option value="all">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 ml-1">Dari Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                        </div>

                        <!-- End Date -->
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300 ml-1">Sampai Tanggal</label>
                            <div class="flex gap-2">
                                <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                    class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-2xl transition-all shadow-lg shadow-blue-600/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    @if(request()->anyFilled(['search', 'category', 'start_date', 'end_date']))
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('articles.index') }}" class="text-sm text-red-500 hover:text-red-600 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset Filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Results Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 dark:border-gray-700 group flex flex-col h-full">
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ $article->imageUrl }}" alt="{{ $article->title }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-1.5 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full uppercase tracking-widest shadow-lg">
                                    {{ $article->category }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-3 flex items-center font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $article->created_at->translatedFormat('d F Y') }}
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors leading-tight">
                                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-3 text-base flex-1 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 font-bold hover:text-blue-700 dark:hover:text-blue-300 transition-all group/link mt-auto">
                                <span class="border-b-2 border-transparent group-hover/link:border-blue-600 dark:group-hover/link:border-blue-400 pb-0.5">Selengkapnya</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover/link:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 mb-6">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Tidak ditemukan berita</h3>
                        <p class="text-gray-500 dark:text-gray-400">Maaf, kami tidak menemukan berita yang sesuai dengan kriteria filter Anda.</p>
                        <a href="{{ route('articles.index') }}" class="mt-8 inline-block px-8 py-3 bg-blue-600 text-white font-bold rounded-full shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all">Lihat Semua Berita</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $articles->links() }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-12">
                <div class="lg:col-span-2">
                    <span class="text-3xl font-extrabold tracking-tight mb-6 block bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">
                        SMK Persatuan Indonesia Maros
                    </span>
                    <p class="text-gray-400 text-lg leading-relaxed max-w-md">
                        {{ $schoolInfo->address ?? 'Jalan Poros Maros-Makassar KM 25, Kabupaten Maros, Sulawesi Selatan.' }}
                    </p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Kontak Kami</h4>
                    <div class="space-y-4">
                        <p class="text-gray-400 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                            </span>
                            {{ $schoolInfo->email ?? 'info@smkpimaros.sch.id' }}
                        </p>
                        <p class="text-gray-400 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 004.812 4.812l.773-1.548a1 1 0 011.06-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                            </span>
                            {{ $schoolInfo->phone ?? '(0411) 123456' }}
                        </p>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Media Sosial</h4>
                    <div class="flex space-x-4">
                        @if(isset($schoolInfo->facebook_url) && $schoolInfo->facebook_url)
                        <a href="{{ $schoolInfo->facebook_url }}" class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        @endif
                        @if(isset($schoolInfo->instagram_url) && $schoolInfo->instagram_url)
                        <a href="{{ $schoolInfo->instagram_url }}" class="w-10 h-10 rounded-full bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.072-4.949-.072zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if(isset($schoolInfo->youtube_url) && $schoolInfo->youtube_url)
                        <a href="{{ $schoolInfo->youtube_url }}" class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-16 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ $schoolInfo->name ?? 'SMK PERSATUAN INDONESIA MAROS' }}. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </footer>

</body>

</html>
