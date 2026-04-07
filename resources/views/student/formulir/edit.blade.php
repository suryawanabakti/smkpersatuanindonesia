<x-app-layout>
    @section('header', 'Formulir Pendaftaran')

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mb-2">
            <h2 class="text-xl font-semibold text-gray-800">Review & Update Data</h2>
            <a href="{{ route('student.formulir.print') }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2-2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak Formulir
            </a>
        </div>
        <div class="mb-6">
            <span class="text-sm text-gray-500 font-medium">No. Pendaftaran: <span
                    class="text-indigo-600">{{ $siswa->no_pendaftaran }}</span></span>
        </div>

        @if ($siswa->status !== 'pending')
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Status pendaftaran Anda saat ini adalah <strong>{{ ucfirst($siswa->status) }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('student.formulir.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            @method('PUT')

            <fieldset>
                <!-- Data Pribadi -->
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Data Pribadi Siswa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('nama_lengkap')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('nisn')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi Tempat Lahir</label>
                            <div class="relative">
                                <select id="provinsi_lahir" disabled
                                    class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors">
                                    <option value="">Memuat provinsi...</option>
                                </select>
                                <div id="loading-provinsi" class="absolute right-8 top-1/2 -translate-y-1/2">
                                    <svg class="animate-spin h-4 w-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tempat Lahir (Kabupaten/Kota)</label>
                            <div class="relative">
                                <select id="kabupaten_lahir" name="tempat_lahir" disabled
                                    class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors">
                                    @if (old('tempat_lahir', $siswa->tempat_lahir))
                                        <option value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" selected>
                                            {{ old('tempat_lahir', $siswa->tempat_lahir) }}</option>
                                    @else
                                        <option value="">-- Pilih Provinsi terlebih dahulu --</option>
                                    @endif
                                </select>
                                <div id="loading-kabupaten" class="absolute right-8 top-1/2 -translate-y-1/2 hidden">
                                    <svg class="animate-spin h-4 w-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('tempat_lahir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('tanggal_lahir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                <option value="L"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Agama</label>
                            <select name="agama"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>
                                    Islam</option>
                                <option value="Kristen"
                                    {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik"
                                    {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>
                                    Hindu</option>
                                <option value="Buddha"
                                    {{ old('agama', $siswa->agama) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha</option>
                                <option value="Konghucu"
                                    {{ old('agama', $siswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah"
                                value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('asal_sekolah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jurusan Pilihan</label>
                            <select name="jurusan_pilihan"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                <option value="TJKT"
                                    {{ old('jurusan_pilihan', $siswa->jurusan_pilihan) == 'TJKT' ? 'selected' : '' }}>
                                    Teknik Jaringan Komputer dan Telekomunikasi</option>
                                <option value="TKRO"
                                    {{ old('jurusan_pilihan', $siswa->jurusan_pilihan) == 'TKRO' ? 'selected' : '' }}>
                                    Teknik Kendaraan Ringan Otomotif</option>
                            </select>
                            @error('jurusan_pilihan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP (WhatsApp)</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('no_hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="mt-8" id="data-orang-tua">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Data Orang Tua / Wali
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Orang Tua / Wali</label>
                            <input type="text" name="nama_wali" value="{{ old('nama_wali', $siswa->nama_wali) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('nama_wali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                            <input type="text" name="pekerjaan_wali"
                                value="{{ old('pekerjaan_wali', $siswa->pekerjaan_wali) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('pekerjaan_wali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Penghasilan</label>
                            <select name="penghasilan_wali"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                <option value="< 1 Juta"
                                    {{ old('penghasilan_wali', $siswa->penghasilan_wali) == '< 1 Juta' ? 'selected' : '' }}>
                                    Kurang dari 1 Juta</option>
                                <option value="1 - 3 Juta"
                                    {{ old('penghasilan_wali', $siswa->penghasilan_wali) == '1 - 3 Juta' ? 'selected' : '' }}>
                                    1 - 3 Juta</option>
                                <option value="3 - 5 Juta"
                                    {{ old('penghasilan_wali', $siswa->penghasilan_wali) == '3 - 5 Juta' ? 'selected' : '' }}>
                                    3 - 5 Juta</option>
                                <option value="> 5 Juta"
                                    {{ old('penghasilan_wali', $siswa->penghasilan_wali) == '> 5 Juta' ? 'selected' : '' }}>
                                    Lebih dari 5 Juta</option>
                            </select>
                            @error('penghasilan_wali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP Orang Tua</label>
                            <input type="text" name="no_hp_orang_tua"
                                value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua) }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                            @error('no_hp_orang_tua')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat Orang Tua / Wali</label>
                            <textarea name="alamat_wali" rows="2"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">{{ old('alamat_wali', $siswa->alamat_wali) }}</textarea>
                            @error('alamat_wali')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Upload Berkas -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Upload Berkas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        @foreach (['foto' => 'Pas Foto 3x4', 'kartu_keluarga' => 'Kartu Keluarga', 'akte_kelahiran' => 'Akte Kelahiran', 'ijazah' => 'Ijazah / SKL', 'kip' => 'KIP (Kartu Indonesia Pintar)'] as $name => $label)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                @if ($siswa->$name)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($siswa->$name) }}" target="_blank"
                                            class="text-xs text-indigo-600 hover:text-indigo-900 underline">Lihat file
                                            saat ini</a>
                                    </div>
                                @endif
                                <input type="file" name="{{ $name }}"
                                    class="mt-1 block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100
                                        ">
                                @error($name)
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                    </div>
                    <p class="mt-4 text-xs text-gray-500">* Format file: JPG, PNG, PDF. Maksimal 2MB.</p>
                </div>

                <!-- Pernyataan -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2 mb-4">Pernyataan Siswa</h3>
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 text-sm text-gray-700">
                        <p class="font-medium mb-4">Dengan ini saya menyatakan:</p>
                        <ol class="list-decimal pl-5 space-y-2">
                            <li>Sanggup mematuhi segala peraturan dan tata tertib yang berlaku di dalam lingkungan SMK
                                Persatuan Indonesia Maros</li>
                            <li>Senantiasa menjaga nama baik sendiri, keluarga, Almamater dan sekolah</li>
                            <li>Memakai pakaian seragam rapi dan bersih sesuai dengan yang ditetapkan</li>
                            <li>Hadir di sekolah tepat waktu sebelum jam 7.30</li>
                            <li>Mengikuti jam pelajaran sampai selesai, dan tidak meninggalkan sekolah sebelum jam
                                pelajaran berakhir 14.00</li>
                            <li>Mengikuti kegiatan sekolah baik yang bersifat intra maupun ekstra kurikuler</li>
                            <li>Melaksanakan tugas piket sekolah sesuai jadwal yang berlaku</li>
                            <li>Tidak membuat sesuatu yang dapat mengakibatkan kegiatan belajar terganggu seperti Ribut
                                / teriak, bermain di dalam kelas dan merusak Fasilitas sekolah</li>
                            <li>Tidak mengaktifkan HP pada saat kegiatan mengajar di dalam kelas</li>
                            <li>Tidak memakai pakaian olahraga selain pakaian sekolah di dalam kelas</li>
                            <li>Tidak berkelahi atau membuat keributan sesama teman sekolah maupun dengan orang lain di
                                luar lingkungan sekolah</li>
                            <li>Tidak memanjat atau melompati pagar / Tembok sekolah</li>
                            <li>Tidak merokok selama berada di dalam sekolah atau sekitar sekolah</li>
                            <li>Tidak berambut panjang / gondrong dengan ukuran 3, 2, 1 cm Atau memakai cat rambut</li>
                            <li>Tidak memakai celana dan baju model ketat</li>
                            <li>Tidak memakai anting-anting, gelang dan kalung bagi laki-laki</li>
                            <li>Tidak memakai topi yang bukan topi sekolah selama berada di sekolah</li>
                            <li>Tidak memakai sandal kesekolah kecuali sepatu yang telah ditetapkan</li>
                            <li>Tidak memakai atau membawa obat terlarang, membawa VCD atau gambar porno ke dalam
                                lingkungan sekolah</li>
                            <li>Tidak terlibat di dalam peredaran narkoba, ganja dan sabu-sabu</li>
                            <li>Tidak membawa senjata tajam yang dapat mengancam jiwa atau keselamatan orang lain</li>
                            <li>Tidak bersolek yang berlebihan bagi wanita</li>
                            <li>Tidak mengambil atau memindahkan sesuatu barang milik sekolah/orang lain.</li>
                        </ol>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>

            </fieldset>

        </form>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // API Wilayah Emsifa
            const provinsiSelect = document.getElementById('provinsi_lahir');
            const kabupatenSelect = document.getElementById('kabupaten_lahir');
            const urlProvinsi = 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
            const oldTempatLahir = `{!! addslashes(old('tempat_lahir', $siswa->tempat_lahir)) !!}`;

            const loadingProvinsi = document.getElementById('loading-provinsi');
            const loadingKabupaten = document.getElementById('loading-kabupaten');

            if (provinsiSelect && kabupatenSelect) {
                // Fetch Provinces
                provinsiSelect.disabled = true;
                fetch(urlProvinsi)
                    .then(response => response.json())
                    .then(provinces => {
                        provinsiSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                        provinces.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = province.name;
                            provinsiSelect.appendChild(option);
                        });
                        provinsiSelect.disabled = false;
                        if (loadingProvinsi) loadingProvinsi.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching provinces:', error);
                        provinsiSelect.innerHTML = '<option value="">Gagal memuat provinsi</option>';
                        if (loadingProvinsi) loadingProvinsi.classList.add('hidden');
                    });

                // Fetch Regencies on Province Change
                provinsiSelect.addEventListener('change', function() {
                    const provinceId = this.value;

                    if (provinceId) {
                        kabupatenSelect.innerHTML = '<option value="">Memuat kabupaten/kota...</option>';
                        kabupatenSelect.disabled = true;
                        if (loadingKabupaten) loadingKabupaten.classList.remove('hidden');

                        const urlKabupaten =
                            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`;
                        fetch(urlKabupaten)
                            .then(response => response.json())
                            .then(regencies => {
                                kabupatenSelect.innerHTML =
                                    '<option value="">-- Pilih Kabupaten/Kota --</option>';
                                regencies.forEach(regency => {
                                    const option = document.createElement('option');
                                    option.value = regency.name;
                                    option.textContent = regency.name;
                                    kabupatenSelect.appendChild(option);
                                });
                                kabupatenSelect.disabled = false;
                                if (loadingKabupaten) loadingKabupaten.classList.add('hidden');
                                kabupatenSelect.dispatchEvent(new Event('change'));
                            })
                            .catch(error => {
                                console.error('Error fetching regencies:', error);
                                kabupatenSelect.innerHTML =
                                    '<option value="">Gagal memuat kabupaten</option>';
                                if (loadingKabupaten) loadingKabupaten.classList.add('hidden');
                            });
                    } else {
                        kabupatenSelect.innerHTML =
                            '<option value="">-- Pilih Provinsi terlebih dahulu --</option>';
                        kabupatenSelect.disabled = true;
                        if (oldTempatLahir) {
                            kabupatenSelect.innerHTML =
                                `<option value="${oldTempatLahir}" selected>${oldTempatLahir}</option>`;
                            kabupatenSelect.disabled = false;
                        }
                        kabupatenSelect.dispatchEvent(new Event('change'));
                    }
                });
            }

            const fields = [{
                    name: 'nama_lengkap',
                    required: true
                },
                {
                    name: 'provinsi_lahir',
                    required: true
                },
                {
                    name: 'nisn',
                    required: true
                },
                {
                    name: 'tempat_lahir',
                    required: true
                },
                {
                    name: 'tanggal_lahir',
                    required: true
                },
                {
                    name: 'jenis_kelamin',
                    required: true
                },
                {
                    name: 'agama',
                    required: true
                },
                {
                    name: 'asal_sekolah',
                    required: true
                },
                {
                    name: 'jurusan_pilihan',
                    required: true
                },
                {
                    name: 'no_hp',
                    required: true
                },
                {
                    name: 'alamat',
                    required: true
                },
                {
                    name: 'nama_wali',
                    required: true
                },
                {
                    name: 'pekerjaan_wali',
                    required: true
                },
                {
                    name: 'penghasilan_wali',
                    required: true
                },
                {
                    name: 'no_hp_orang_tua',
                    required: true
                },
                {
                    name: 'alamat_wali',
                    required: true
                },
                {
                    name: 'foto',
                    required: true,
                    isFile: true
                },
                {
                    name: 'kartu_keluarga',
                    required: true,
                    isFile: true
                },
                {
                    name: 'akte_kelahiran',
                    required: true,
                    isFile: true
                },
                {
                    name: 'ijazah',
                    required: true,
                    isFile: true
                },
                {
                    name: 'kip',
                    required: false,
                    isFile: true
                }
            ];

            const submitBtn = document.querySelector('button[type="submit"]');

            function checkLocks() {
                let isLocked = false;

                for (let i = 0; i < fields.length; i++) {
                    const fieldDef = fields[i];
                    const input = document.querySelector(`[name="${fieldDef.name}"]`);

                    if (!input) continue;

                    // Lock/Unlock Logic
                    if (isLocked) {
                        input.disabled = true;
                        input.classList.add('bg-gray-100', 'cursor-not-allowed');
                        input.classList.remove('bg-white');
                    } else {
                        input.disabled = false;
                        input.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        input.classList.add('bg-white');
                    }

                    // Check if current field is satisfied
                    let satisfied = false;

                    if (fieldDef.isFile) {
                        // File is satisfied if selected OR if a previous file exists (link present in parent)
                        const hasExistingFile = input.parentElement.querySelector('a') !== null;
                        if (input.value || hasExistingFile) {
                            satisfied = true;
                        }
                    } else {
                        if (input.value && input.value.trim() !== '') {
                            satisfied = true;
                        }
                    }

                    // If required field is NOT satisfied, lock the rest
                    if (fieldDef.required && !satisfied) {
                        isLocked = true;
                    }
                }

                // Lock submit button if the sequence is broken (isLocked became true inside loop)
                // However, the loop logic guarantees isLocked becomes true at the first unfilled required field.
                // The submit button is AFTER the last field.
                // So if isLocked is true at the end of the loop, submit should be locked.

                if (isLocked) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            // Bind events
            fields.forEach(f => {
                const input = document.querySelector(`[name="${f.name}"]`);
                if (input) {
                    input.addEventListener('input', checkLocks);
                    input.addEventListener('change', checkLocks);
                }
            });

            // Initial check
            checkLocks();
        });
    </script>
</x-app-layout>
