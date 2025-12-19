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

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600 tracking-tight">
                        SMK PI MAROS
                    </span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                    <a href="#jurusan"
                        class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Jurusan</a>
                    <a href="#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Tentang
                        Kami</a>
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Login Siswa</a>
                    <a href="{{ route('pendaftaran.index') }}"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition-all shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 -z-10"></div>
        <div
            class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-blue-100/50 to-transparent skew-x-12 transform translate-x-20">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-4xl mx-auto">
                <div
                    class="inline-block mb-6 px-4 py-1.5 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm tracking-wide uppercase">
                    Penerimaan Peserta Didik Baru 2025/2026
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-tight">
                    Wujudkan Masa Depan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                        Cerah Bersama Kami
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    SMK Persatuan Indonesia Maros mencetak lulusan yang kompeten, berkarakter, dan siap kerja di dunia
                    industri modern.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('pendaftaran.index') }}"
                        class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-full transition-all shadow-xl shadow-blue-600/30 transform hover:-translate-y-1 hover:scale-105">
                        Daftar Sekarang
                    </a>
                    <a href="#jurusan"
                        class="px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 text-lg font-bold rounded-full border border-gray-200 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Lihat Jurusan
                    </a>
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
                    <div class="text-4xl font-bold text-blue-600 mb-1">5</div>
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

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Komputer & Jaringan</h3>
                    <p class="text-gray-500 leading-relaxed">Mempelajari perakitan komputer, instalasi jaringan,
                        administrasi server, dan keamanan siber.</p>
                </div>

                <!-- Jurusan 2 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div
                        class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Rekayasa Perangkat Lunak</h3>
                    <p class="text-gray-500 leading-relaxed">Fokus pada pengembangan software, aplikasi mobile, web
                        development, dan database.</p>
                </div>

                <!-- Jurusan 3 -->
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
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Farmasi Klinis</h3>
                    <p class="text-gray-500 leading-relaxed">Mempelajari peracikan obat, pelayanan farmasi, dan
                        manajemen apotek.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <span class="text-2xl font-bold tracking-tight mb-4 block">SMK PI MAROS</span>
                    <p class="text-gray-400">Jalan Poros Maros-Makassar KM 25, Kabupaten Maros, Sulawesi Selatan.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400">info@smkpimaros.sch.id</p>
                    <p class="text-gray-400">(0411) 123456</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">YouTube</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} SMK PERSATUAN INDONESIA MAROS. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>