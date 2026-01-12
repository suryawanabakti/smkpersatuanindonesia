<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SMK PERSATUAN INDONESIA MAROS') }}</title>

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
    </style>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">

  <nav class="fixed w-full z-50 bg-white shadow-lg dark:bg-gray-900 dark:shadow-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <div class="flex-shrink-0 flex items-center">
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 tracking-tight">
                    SMK Persatuan Indonesia Maros
                </span>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Beranda</a>
                <a href="#jurusan" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Jurusan</a>
                <a href="#tentang" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Tentang Kami</a>
                <a href="{{ route('articles.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Berita</a>
                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors">Login Akun</a>
                <a href="{{ route('pendaftaran.index') }}"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30">
                    Daftar Sekarang
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden absolute top-16 left-0 right-0 bg-white dark:bg-gray-900 shadow-xl border-t border-gray-200 dark:border-gray-800 z-40">
        <div class="flex flex-col space-y-0 px-4 py-4">
            <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Beranda</a>
            <a href="#jurusan" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Jurusan</a>
            <a href="#tentang" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Tentang Kami</a>
            <a href="{{ route('articles.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Berita</a>
            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg">Login Akun</a>
            <a href="{{ route('pendaftaran.index') }}"
                class="mt-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30 text-center">
                Daftar Sekarang
            </a>
        </div>
    </div>
</nav>
    <!-- Hero Section -->
    <section class="pt-20 lg:pt-32 pb-20 lg:pb-40 overflow-hidden relative">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 -z-10"></div>
        
        <!-- Decorative abstract shapes -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-100/20 to-transparent skew-x-12 transform translate-x-32 -z-10"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100/50 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Text Content -->
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-block mb-6 px-4 py-1.5 rounded-full bg-blue-100 text-blue-700 font-bold text-sm tracking-wide uppercase">
                        PPDB ONLINE {{ date('Y') }}/{{ date('Y', strtotime('+1 year')) }}
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-tight">
                        {{ $schoolInfo->name ?? 'SMK Persatuan Indonesia Maros' }} <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                            Wujudkan Masa Depan
                        </span>
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        {{ $schoolInfo->description ?? 'Mencetak lulusan yang kompeten, berkarakter, dan siap kerja di dunia industri modern dengan kurikulum berbasis industri.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('pendaftaran.index') }}"
                            class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-full transition-all shadow-xl shadow-blue-600/30 transform hover:-translate-y-1 hover:scale-105 text-center">
                            Daftar Sekarang
                        </a>
                        <a href="#jurusan"
                            class="px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 text-lg font-bold rounded-full border border-gray-200 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-center">
                            Lihat Jurusan
                        </a>
                    </div>
                </div>

                <!-- Image Content -->
                <div class="order-1 lg:order-2 relative group">
                    <!-- Glassmorphism card behind image -->
                    <div class="absolute -inset-4 bg-gradient-to-tr from-blue-600/20 to-indigo-600/20 rounded-[2.5rem] blur-2xl opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl border-8 border-white transform lg:rotate-2 group-hover:rotate-0 transition-all duration-500 bg-white">
                        <img src="{{ asset('image.jpeg') }}" 
                            alt="{{ $schoolInfo->name ?? 'SMK Persatuan Indonesia Maros' }}" 
                            class="w-full h-full object-cover aspect-[4/3] lg:aspect-square">
                        
                        <!-- Floating Badge -->
                     
                    </div>

                    <!-- Decorative dots -->
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 text-blue-200/50 opacity-50 hidden lg:block">
                        <svg viewBox="0 0 100 100" class="w-full h-full" fill="currentColor">
                            <pattern id="dot-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2"></circle>
                            </pattern>
                            <rect width="100" height="100" fill="url(#dot-pattern)"></rect>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-10 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-1">15+</div>
                    <div class="text-gray-500 font-medium">Tahun Pengalaman</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-1">2</div>
                    <div class="text-gray-500 font-medium">Jurusan Unggulan</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-1">50+</div>
                    <div class="text-gray-500 font-medium">Mitra Industri</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-1">1000+</div>
                    <div class="text-gray-500 font-medium">Alumni Sukses</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Section -->
    <section id="jurusan" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Pilihan Jurusan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pilih jurusan yang sesuai dengan minat dan bakatmu. Kami
                    menyediakan fasilitas praktik terkini.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Jurusan 1 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div
                        class="w-14 h-14 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</h3>
                    <p class="text-gray-500 leading-relaxed">Mempelajari perakitan komputer, instalasi jaringan,
                        administrasi server, dan keamanan siber.</p>
                </div>

                <!-- Jurusan 2 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div
                        class="w-14 h-14 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                  <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Kendaraan Ringan Otomotif (TKRO)</h3>
<p class="text-gray-500 leading-relaxed">
    Mempelajari pemeliharaan mesin (engine), sasis, sistem pemindah tenaga, hingga kelistrikan otomotif pada kendaraan roda empat secara menyeluruh.
</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Tentang Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat SMK Persatuan Indonesia Maros</p>
            </div>

            <!-- Visi & Misi -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi lembaga pendidikan kejuruan yang unggul, menghasilkan lulusan yang kompeten, berkarakter, dan berdaya saing global di bidang teknologi dan industri.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-100">
                    <div class="w-14 h-14 bg-indigo-600 text-white rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="text-gray-700 leading-relaxed space-y-2">
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-2">•</span>
                            <span>Menyelenggarakan pendidikan berbasis kompetensi dan karakter</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-2">•</span>
                            <span>Mengembangkan kerjasama dengan dunia usaha dan industri</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-600 mr-2">•</span>
                            <span>Membekali siswa dengan keterampilan abad 21</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Core Values -->
            <div class="mb-16">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Nilai-Nilai Inti</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Integritas</h4>
                        <p class="text-sm text-gray-600">Jujur dan bertanggung jawab</p>
                    </div>

                    <div class="text-center group">
                        <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Inovasi</h4>
                        <p class="text-sm text-gray-600">Kreatif dan adaptif</p>
                    </div>

                    <div class="text-center group">
                        <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Kolaborasi</h4>
                        <p class="text-sm text-gray-600">Kerjasama tim yang solid</p>
                    </div>

                    <div class="text-center group">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Keunggulan</h4>
                        <p class="text-sm text-gray-600">Selalu yang terbaik</p>
                    </div>
                </div>
            </div>

            <!-- Facilities -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Fasilitas Unggulan</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Lab Komputer Modern</h4>
                        <p class="text-sm text-gray-600">Dilengkapi dengan perangkat terkini dan koneksi internet berkecepatan tinggi</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Workshop Otomotif</h4>
                        <p class="text-sm text-gray-600">Bengkel praktik dengasn peralatan standar industri otomotif</p>
                    </div>

              

                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Server & Jaringan</h4>
                        <p class="text-sm text-gray-600">Infrastruktur jaringan untuk praktik administrasi sistem</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Area Olahraga</h4>
                        <p class="text-sm text-gray-600">Lapangan basket, futsal, dan fasilitas olahraga lainnya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
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
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Close menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const navHeight = 64; // Height of navbar (16*4 = 64px)
                        const targetPosition = target.offsetTop - navHeight;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    });
</script>
</body>

</html>