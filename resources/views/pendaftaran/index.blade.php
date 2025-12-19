<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Siswa Baru - SMK PI MAROS</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('landing') }}" class="text-xl font-bold text-gray-900 tracking-tight">SMK PI MAROS</a>
                <a href="{{ route('landing') }}" class="text-sm text-gray-500 hover:text-blue-600 font-medium">Kembali ke Beranda</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Formulir Pendaftaran Siswa Baru</h1>
                <p class="text-gray-500">Silakan isi data diri Anda dengan benar dan lengkap.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                @csrf
                
                <div class="p-8 space-y-6">
                    <!-- Data Akun -->
                    <div class="pb-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Akun</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" placeholder="email@contoh.com" required>
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" id="password" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" required>
                                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" required>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                        <div class="space-y-6">
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" placeholder="Sesuai Ijazah" required>
                                @error('nama_lengkap') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                                    <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" required>
                                    @error('nisn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" placeholder="SMP/MTS..." required>
                                    @error('asal_sekolah') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. HP Siswa (WhatsApp)</label>
                                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" placeholder="08..." required>
                                    @error('no_hp') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="no_hp_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">No. HP Orang Tua (Untuk Notifikasi)</label>
                                    <input type="text" name="no_hp_orang_tua" id="no_hp_orang_tua" value="{{ old('no_hp_orang_tua') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" placeholder="08..." required>
                                    <p class="text-xs text-gray-500 mt-1">Kami akan mengirimkan notifikasi pendaftaran ke nomor ini.</p>
                                    @error('no_hp_orang_tua') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="jurusan_pilihan" class="block text-sm font-medium text-gray-700 mb-1">Pilihan Jurusan</label>
                                <select name="jurusan_pilihan" id="jurusan_pilihan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="TKJ" {{ old('jurusan_pilihan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan</option>
                                    <option value="RPL" {{ old('jurusan_pilihan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                    <option value="Farmasi" {{ old('jurusan_pilihan') == 'Farmasi' ? 'selected' : '' }}>Farmasi Klinis</option>
                                </select>
                                @error('jurusan_pilihan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-sm py-3 px-4 text-lg" required>{{ old('alamat') }}</textarea>
                                @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                    <button type="submit" class="px-8 py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold rounded-xl border-2 border-gray-900 shadow-[4px_4px_0px_0px_rgba(17,24,39,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all text-lg">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
