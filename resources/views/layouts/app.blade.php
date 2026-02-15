<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('logo2.jpeg') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex" id="app-container">
        <!-- Mobile Backdrop -->
        <div id="sidebar-backdrop"
            class="fixed inset-0 bg-gray-900/50 z-20 hidden lg:hidden transition-opacity opacity-0"
            onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-100 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-lg lg:shadow-none flex flex-col">
            <div class="h-16 flex items-center px-8 border-b border-gray-100 bg-white">
                <span
                    class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600 tracking-tight">SMK
                    Persatuan Indonesia Maros</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">


                @hasanyrole('panitia|admin')
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    @role('admin')
                        <a href="{{ route('panitia.jadwal.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.jadwal.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.jadwal.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Jadwal Pendaftaran
                        </a>
                    @endrole

                    @can('manage spp')
                        <a href="{{ route('panitia.spp.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.spp.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.spp.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kelola SPP
                        </a>
                    @endcan

                    @can('manage articles')
                        <a href="{{ route('panitia.articles.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.articles.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.articles.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            Article
                        </a>
                    @endcan

                    @can('view pendaftaran siswa')
                        <a href="{{ route('panitia.pendaftaran.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.pendaftaran.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.pendaftaran.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Data Siswa
                        </a>
                    @endcan

                    @role('admin')
                        <a href="{{ route('panitia.school_information.edit') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.school_information.edit') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.school_information.edit') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                            </svg>
                            Informasi Sekolah
                        </a>
                    @endrole
                    @can('manage selection tests')
                        <a href="{{ route('panitia.tests.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.tests.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.tests.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Informasi Wawancara
                        </a>
                    @endcan
                    @role('admin|panitia')
                        <a href="{{ route('my_suggestions.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('my_suggestions.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('my_suggestions.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            Saran dan Masukan
                        </a>
                    @endrole



                    @can('manage panitia')
                        <a href="{{ route('panitia.users.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('panitia.users.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('panitia.users.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Kelola Panitia
                        </a>
                    @endcan
                @endhasanyrole

                @role('bendahara')
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Bendahara</p>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('bendahara.pembayaran.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('bendahara.pembayaran.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('bendahara.pembayaran.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Data Pembayaran
                    </a>
                    <a href="{{ route('bendahara.laporan.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('bendahara.laporan.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('bendahara.laporan.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan Keuangan
                    </a>
                    <a href="{{ route('my_suggestions.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('my_suggestions.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('my_suggestions.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        Saran Masuk
                    </a>
                @endrole

                @role('kepala_sekolah')
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Kepala Sekolah
                    </p>
                    <a href="{{ route('kepala_sekolah.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('kepala_sekolah.dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('kepala_sekolah.dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('kepala_sekolah.laporan_ppdb.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('kepala_sekolah.laporan_ppdb.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('kepala_sekolah.laporan_ppdb.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan PPDB
                    </a>
                    <a href="{{ route('kepala_sekolah.laporan_keuangan.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('kepala_sekolah.laporan_keuangan.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('kepala_sekolah.laporan_keuangan.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Laporan Keuangan
                    </a>
                    <a href="{{ route('kepala_sekolah.suggestions.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('kepala_sekolah.suggestions.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('kepala_sekolah.suggestions.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        Saran & Masukan
                    </a>
                @endrole

                @unlessrole('panitia|bendahara|kepala_sekolah|admin')
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Siswa</p>
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('student.dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('student.dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Dashboard Siswa
                    </a>
                    <a href="{{ route('student.formulir.edit') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('student.formulir.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('student.formulir.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Formulir Pendaftaran
                    </a>
                    <a href="{{ route('student.parent_data') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('student.parent_data') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('student.parent_data') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Data Orang Tua
                    </a>
                    <a href="{{ route('student.payment.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('student.payment.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('student.payment.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pembayaran
                    </a>
                @endunlessrole

                <!-- Reports Dropdown (Keeping this generally available or specific? "Laporan" was generic before) -->
                <!-- Assuming Admin or similar for this one, I'll allow it for everyone or maybe just not touch permissions not requested -->
                <div class="space-y-1 mt-4">
                    @role('kepala_sekolah')
                        <button type="button" onclick="toggleFilesDropdown()"
                            class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all duration-200 group focus:outline-none">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-gray-500 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Laporan (System)
                            </div>
                            <svg id="files-chevron"
                                class="h-4 w-4 text-gray-400 group-hover:text-gray-500 transition-transform duration-200 {{ request()->routeIs('reports.*') ? 'rotate-180' : '' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    @endrole
                    <div id="files-dropdown"
                        class="{{ request()->routeIs('reports.*') ? '' : 'hidden' }} pl-12 space-y-1">
                        <a href="{{ route('reports.login_activity') }}"
                            class="block px-4 py-2 text-sm font-medium {{ request()->routeIs('reports.login_activity') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-lg transition-colors">
                            Login Activity
                        </a>
                    </div>
                </div>

                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Pengaturan</p>
                <a href="{{ route('account.edit') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('account.*') ? 'bg-indigo-50 text-indigo-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="h-5 w-5 mr-3 {{ request()->routeIs('account.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Akun Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
               text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-gray-500 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </nav>

            <!-- User Profile (Sidebar Footer) -->
            <div class="p-4 border-t border-gray-100">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 border border-gray-100">
                    <div class="flex-shrink-0">
                        <div
                            class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ Auth::user()->email ?? 'admin@fkuh.com' }}
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50/50">
            <!-- Topbar -->
            <header
                class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200/60 sticky top-0 z-10 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                <div class="flex items-center">
                    <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 mr-3">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 ml-1 lg:ml-0">
                        @yield('header', 'Dashboard')
                    </h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notification Bell -->
                    <div class="relative ml-auto">
                        <button type="button"
                            class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            onclick="toggleNotifications()">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                            @endif
                        </button>

                        <!-- Notifications Dropdown -->
                        <div id="notifications-dropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="text-sm font-medium text-gray-900">Notifikasi</h3>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span
                                        class="text-xs text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">{{ auth()->user()->unreadNotifications->count() }}
                                        Baru</span>
                                @endif
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    @if ($notification->type === 'App\Notifications\NewSuggestion')
                                        <a href="{{ route('my_suggestions.show', $notification->data['suggestion_id']) }}"
                                            class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3 w-0 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Saran Baru</p>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ Str::limit($notification->data['title'] ?? 'Tanpa Judul', 30) }}
                                                    </p>
                                                    <p class="text-xs text-gray-400 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($notification->type === 'App\Notifications\ActivityNotification')
                                        <div
                                            class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="h-8 w-8 {{ $notification->data['type'] === 'delete' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }} rounded-full flex items-center justify-center">
                                                        @if ($notification->data['type'] === 'delete')
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        @elseif($notification->data['type'] === 'update')
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                        @else
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="ml-3 w-0 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">Aktivitas Sistem</p>
                                                    <p class="text-xs text-gray-600 mt-1">
                                                        {{ $notification->data['message'] }}
                                                    </p>
                                                    <p class="text-xs text-gray-400 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="px-4 py-6 text-center text-gray-500 text-sm">
                                        Tidak ada notifikasi baru
                                    </div>
                                @endforelse
                            </div>
                            <div class="border-t border-gray-100 flex divide-x divide-gray-100">
                                <a href="{{ route('my_suggestions.index') }}"
                                    class="flex-1 block px-4 py-2 text-xs text-center text-indigo-600 hover:text-indigo-500 hover:bg-gray-50 font-medium">
                                    Saran Masuk
                                </a>
                                @role('kepala_sekolah')
                                    <a href="{{ route('reports.login_activity') }}"
                                        class="flex-1 block px-4 py-2 text-xs text-center text-indigo-600 hover:text-indigo-500 hover:bg-gray-50 font-medium">
                                        Log Sistem
                                    </a>
                                @endrole
                            </div>
                        </div>
                    </div>

                    <!-- User Profile Info -->
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-sm font-semibold text-gray-900">
                            {{ Auth::user()->pendaftaran->nama_lengkap ?? Auth::user()->name }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ Auth::user()->email }}
                        </span>
                    </div>

                    <!-- User Photo -->
                    <div class="relative">
                        @if (Auth::user()->pendaftaran && Auth::user()->pendaftaran->foto)
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-100 shadow-sm"
                                src="{{ asset('storage/' . Auth::user()->pendaftaran->foto) }}"
                                alt="{{ Auth::user()->name }}">
                        @else
                            <div
                                class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border-2 border-indigo-50 shadow-sm">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Divider -->
                    <div class="hidden sm:block h-8 w-px bg-gray-200 mx-2"></div>

                    <!-- Logout Button -->

                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            if (sidebar.classList.contains('-translate-x-full')) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                }, 10);
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('opacity-0');
                setTimeout(() => {
                    backdrop.classList.add('hidden');
                }, 300);
            }
        }

        function toggleFilesDropdown() {
            const dropdown = document.getElementById('files-dropdown');
            const chevron = document.getElementById('files-chevron');

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        function toggleNotifications() {
            const dropdown = document.getElementById('notifications-dropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
