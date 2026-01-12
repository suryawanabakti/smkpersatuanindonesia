<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->title }} - {{ config('app.name', 'SMK PERSATUAN INDONESIA MAROS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .prose img {
            border-radius: 0.75rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }
        .prose h2 {
            font-weight: 700;
            font-size: 1.5em;
            margin-top: 2em;
            margin-bottom: 1em;
            line-height: 1.3333333;
        }
        .prose ul {
            list-style-type: disc;
            padding-left: 1.625em;
            margin-top: 1.25em;
            margin-bottom: 1.25em;
        }
        .prose ol {
            list-style-type: decimal;
            padding-left: 1.625em;
            margin-top: 1.25em;
            margin-bottom: 1.25em;
        }
        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-sans antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 tracking-tight cursor-pointer">
                        SMK Persatuan Indonesia Maros
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('landing') }}" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                    <a href="{{ route('landing') }}#jurusan"
                        class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Jurusan</a>
                    <a href="{{ route('landing') }}#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Tentang
                        Kami</a>
                    <a href="{{ route('articles.index') }}" class="text-blue-600 font-medium transition-colors">Berita</a>
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Login Siswa</a>
                    <a href="{{ route('pendaftaran.index') }}"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="hidden md:hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40">
            <div class="fixed right-0 top-0 h-full w-64 bg-white shadow-2xl transform transition-transform duration-300 ease-in-out">
                <div class="flex justify-end p-4">
                    <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col space-y-4 px-6 py-4">
                    <a href="{{ route('landing') }}" class="text-gray-600 hover:text-blue-600 font-medium transition-colors py-2 mobile-menu-link">Beranda</a>
                    <a href="{{ route('landing') }}#jurusan" class="text-gray-600 hover:text-blue-600 font-medium transition-colors py-2 mobile-menu-link">Jurusan</a>
                    <a href="{{ route('landing') }}#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors py-2 mobile-menu-link">Tentang Kami</a>
                    <a href="{{ route('landing') }}#berita" class="text-blue-600 font-medium transition-colors py-2 mobile-menu-link">Berita</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium transition-colors py-2">Login Siswa</a>
                    <a href="{{ route('pendaftaran.index') }}"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30 text-center">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-32 pb-20">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Header -->
            <header class="text-center mb-12">
                <div class="flex justify-center mb-6">
                     <span class="px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-bold rounded-full uppercase tracking-wider">
                        {{ $article->category }}
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center justify-center text-gray-500 text-sm md:text-base space-x-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <time datetime="{{ $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d') }}">
                            {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}
                        </time>
                    </div>
                    @if($article->author)
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ $article->author->name }}</span>
                    </div>
                    @endif
                </div>
            </header>

            <!-- Featured Image -->
            <div class="relative w-full aspect-video rounded-3xl overflow-hidden shadow-2xl mb-12 group">
                <img src="{{ $article->imageUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <!-- Article Content -->
            <div class="prose prose-lg md:prose-xl prose-blue mx-auto text-gray-700 leading-relaxed mb-16">
                {!! nl2br($article->content) !!}
            </div>

            <!-- Back Button -->
            <div class="flex justify-center mb-24">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar Berita
                </a>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="border-t border-gray-200 pt-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-8 text-center">Berita Lainnya</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col h-full">
                        <div class="relative overflow-hidden h-48">
                            <img src="{{ $related->imageUrl }}" alt="{{ $related->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-bold rounded-full uppercase tracking-wider shadow-sm">
                                    {{ $related->category }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="text-xs text-gray-500 mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $related->created_at->format('d M Y') }}
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('articles.show', $related) }}">{{ $related->title }}</a>
                            </h4>
                            <a href="{{ route('articles.show', $related) }}" class="inline-flex items-center text-blue-600 text-sm font-semibold hover:text-blue-700 transition-colors mt-auto">
                                Baca 
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif
        </article>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <span class="text-2xl font-bold tracking-tight mb-4 block">{{ $schoolInfo->name ?? 'SMK Persatuan Indonesia Maros' }}</span>
                    <p class="text-gray-400">{{ $schoolInfo->address ?? 'Jalan Poros Maros-Makassar KM 25, Kabupaten Maros, Sulawesi Selatan.' }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400">{{ $schoolInfo->email ?? 'info@smkpimaros.sch.id' }}</p>
                    <p class="text-gray-400">{{ $schoolInfo->phone ?? '(0411) 123456' }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        @if(isset($schoolInfo->facebook_url) && $schoolInfo->facebook_url)
                        <a href="{{ $schoolInfo->facebook_url }}" class="text-gray-400 hover:text-white transition-colors">Facebook</a>
                        @endif
                        @if(isset($schoolInfo->instagram_url) && $schoolInfo->instagram_url)
                        <a href="{{ $schoolInfo->instagram_url }}" class="text-gray-400 hover:text-white transition-colors">Instagram</a>
                        @endif
                        @if(isset($schoolInfo->youtube_url) && $schoolInfo->youtube_url)
                        <a href="{{ $schoolInfo->youtube_url }}" class="text-gray-400 hover:text-white transition-colors">YouTube</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ $schoolInfo->name ?? 'SMK PERSATUAN INDONESIA MAROS' }}. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality (Replicated from landing)
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.remove('hidden');
                });
            }

            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            }

            if (mobileMenu) {
                mobileMenu.addEventListener('click', function(e) {
                    if (e.target === mobileMenu) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }

            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>
