<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pendaftaran Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Status Badge & Confirmation Checkbox -->
                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-4">
                            @if($siswa->foto)
                                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="h-20 w-20 rounded-full object-cover border-4 border-indigo-50">
                            @else
                                <div class="h-20 w-20 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-2xl border-4 border-indigo-50">
                                    {{ substr($siswa->nama_lengkap, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $siswa->nama_lengkap }}</h1>
                                <p class="text-sm text-gray-500">{{ $siswa->nisn }} | {{ $siswa->jurusan_pilihan }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-2">
                             <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200">
                                <label for="status_konfirmasi" class="text-sm font-medium text-gray-700 cursor-pointer select-none">Sudah Dicek & Sesuai</label>
                                <input type="checkbox" id="status_konfirmasi" 
                                       onchange="updateStatusKonfirmasi({{ $siswa->id }}, this.checked)"
                                       {{ $siswa->status_konfirmasi ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5 cursor-pointer">
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800">
                                Status: {{ ucfirst($siswa->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Details -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Data Pribadi -->
                            <section>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Data Pribadi
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Nama Lengkap</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->nama_lengkap }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">NISN</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->nisn }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Tempat, Tanggal Lahir</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Jenis Kelamin</p>
                                        <p class="font-medium text-gray-900">{{ ucfirst($siswa->jenis_kelamin) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Agama</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->agama }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Asal Sekolah</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->asal_sekolah }}</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Data Kontak & Alamat -->
                            <section>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Kontak & Alamat
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Email</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">No. HP Siswa</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->no_hp }}</p>
                                    </div>
                                    <div class="col-span-1 md:col-span-2">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Alamat Lengkap</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->alamat }}</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Data Wali -->
                            <section>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                     <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Data Orang Tua / Wali
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Nama Wali</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->nama_wali }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">No. HP Wali</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->no_hp_orang_tua }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Pekerjaan</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->pekerjaan_wali }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Penghasilan</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->penghasilan_wali }}</p>
                                    </div>
                                    <div class="col-span-1 md:col-span-2">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Alamat Wali</p>
                                        <p class="font-medium text-gray-900">{{ $siswa->alamat_wali }}</p>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <!-- Right Column: Documents & Actions -->
                        <div class="space-y-8">
                            <!-- Dokumen -->
                            <section>
                                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Dokumen Pendukung
                                </h3>
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 space-y-4">
                                     @foreach(['kartu_keluarga' => 'Kartu Keluarga', 'akte_kelahiran' => 'Akte Kelahiran', 'ijazah' => 'Ijazah', 'kip' => 'KIP'] as $field => $label)
                                        <div class="flex items-center justify-between pb-2 border-b border-gray-200 last:border-0 last:pb-0">
                                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                            @if($siswa->$field)
                                                <a href="{{ asset('storage/' . $siswa->$field) }}" target="_blank" class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full hover:bg-indigo-100 transition-colors">
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-xs font-medium text-gray-400 italic">Belum upload</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <!-- Verification Form -->
                            <section class="bg-white p-6 rounded-xl border-2 border-indigo-50 shadow-sm">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Keputusan Panitia</h3>
                                <form action="{{ route('panitia.pendaftaran.verify', $siswa) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="status" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Update Status Pendaftaran</label>
                                        <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="pending" {{ $siswa->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="diterima" {{ $siswa->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="ditolak" {{ $siswa->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                                        Simpan Keputusan
                                    </button>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function updateStatusKonfirmasi(siswaId, isChecked) {
            fetch(`/panitia/pendaftaran/${siswaId}/update-status-konfirmasi`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status_konfirmasi: isChecked
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optional: Show toast notification
                    console.log('Status updated successfully');
                } else {
                    alert('Gagal memperbarui status');
                    // Revert checkbox if failed
                    event.target.checked = !isChecked;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem');
                // Revert checkbox if failed
                event.target.checked = !isChecked;
            });
        }
    </script>
</x-app-layout>
