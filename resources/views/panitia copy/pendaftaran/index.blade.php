<x-app-layout>
    @section('header', 'Data Siswa')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filter Section -->
                    <div class="mb-6 bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <form method="GET" action="{{ route('panitia.pendaftaran.index') }}">
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-6">

                                <!-- Cari -->
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Cari</label>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Nama / NISN / Asal Sekolah"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm placeholder-gray-400 transition-colors">
                                </div>

                                <!-- Jurusan -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Jurusan</label>
                                    <select name="jurusan"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                        <option value="">Semua Jurusan</option>
                                        <option value="TJKT" {{ request('jurusan') == 'TJKT' ? 'selected' : '' }}>Teknik Jaringan Komputer dan Telekomunikasi</option>
                                        <option value="TKRO" {{ request('jurusan') == 'TKRO' ? 'selected' : '' }}>Teknik Kendaraan Ringan Otomotif</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Status</label>
                                    <select name="status"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>

                                <!-- Konfirmasi -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Konfirmasi</label>
                                    <select name="konfirmasi"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                        <option value="">Semua</option>
                                        <option value="1" {{ request('konfirmasi') == '1' ? 'selected' : '' }}>Sudah Dikonfirmasi</option>
                                        <option value="0" {{ request('konfirmasi') == '0' ? 'selected' : '' }}>Belum Dikonfirmasi</option>
                                    </select>
                                </div>

                                <!-- Tahun -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Tahun</label>
                                    <select name="year"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                        <option value="">Semua Tahun</option>
                                        @foreach($availableYears as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Dari Tanggal -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Dari Tanggal</label>
                                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                </div>

                                <!-- Sampai Tanggal -->
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500
                                               text-sm transition-colors">
                                </div>

                            </div>

                            <!-- Button -->
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="submit"
                                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl
                                           hover:bg-indigo-700 transition-colors text-sm font-medium">
                                    Filter Data
                                </button>
                                <a href="{{ route('panitia.pendaftaran.export', request()->all()) }}"
                                    class="bg-green-600 text-dark px-6 py-3 rounded-xl
                                           hover:bg-green-700 transition-colors text-sm font-medium">
                                    Export Siswa
                                </a>
                                <a href="{{ route('panitia.pembayaran.export', request()->all()) }}"
                                    class="bg-emerald-600 text-dark px-6 py-3 rounded-xl
                                           hover:bg-emerald-700 transition-colors text-sm font-medium">
                                    Export Pembayaran
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="mb-4 flex gap-2">
                        {{-- <button type="button" id="bulk-delete-btn" style="display: none;"
                            class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700 transition-colors text-sm font-medium shadow-sm"
                            onclick="confirmBulkDelete()">Hapus Terpilih</button> --}}
                    </div>

                    <form id="bulk-delete-form" action="{{ route('panitia.pendaftaran.bulk_delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @error('ids') <p class="mb-4 text-sm text-red-600 font-medium">{{ $message }}</p> @enderror

                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                  
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Identitas Siswa
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Konfirmasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($siswas as $siswa)
                                    <tr>
                                     
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $siswa->nama_lengkap }}</div>
                                            <div class="text-xs text-gray-500">NISN: {{ $siswa->nisn }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $siswa->jurusan_pilihan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->asal_sekolah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800">
                                                {{ ucfirst($siswa->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <input type="checkbox" 
                                                   onchange="updateStatusKonfirmasi({{ $siswa->id }}, this.checked)"
                                                   {{ $siswa->status_konfirmasi ? 'checked' : '' }}
                                                   {{ $siswa->status !== 'diterima' ? 'disabled' : '' }}
                                                   title="{{ $siswa->status !== 'diterima' ? 'Hanya bisa dikonfirmasi jika status Diterima' : '' }}"
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 {{ $siswa->status !== 'diterima' ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('panitia.pendaftaran.show', $siswa) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                                <button type="button" class="text-red-600 hover:text-red-900" onclick="deleteSiswa({{ $siswa->id }})">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="block md:hidden space-y-4 p-4 bg-gray-50/50 rounded-xl">
                            @forelse ($siswas as $siswa)
                                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm transition-all duration-200 active:scale-[0.98]">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <input type="checkbox" name="ids[]" value="{{ $siswa->id }}" 
                                                       class="siswa-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <h4 class="text-base font-bold text-gray-900 truncate">{{ $siswa->nama_lengkap }}</h4>
                                            </div>
                                            <p class="text-xs text-gray-500 font-medium">NISN: {{ $siswa->nisn }}</p>
                                        </div>
                                        <span class="px-2.5 py-1 text-[10px] uppercase tracking-wider font-extrabold rounded-lg bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800 shadow-sm">
                                            {{ $siswa->status }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-5">
                                        <div class="bg-gray-50/50 p-2.5 rounded-xl border border-gray-50">
                                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Jurusan</p>
                                            <p class="text-xs font-bold text-gray-900 leading-tight">{{ $siswa->jurusan_pilihan }}</p>
                                        </div>
                                        <div class="bg-gray-50/50 p-2.5 rounded-xl border border-gray-50">
                                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Asal Sekolah</p>
                                            <p class="text-xs font-bold text-gray-900 leading-tight">{{ $siswa->asal_sekolah }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 rounded-lg border border-gray-100">
                                                <input type="checkbox" 
                                                       onchange="updateStatusKonfirmasi({{ $siswa->id }}, this.checked)"
                                                       {{ $siswa->status_konfirmasi ? 'checked' : '' }}
                                                       {{ $siswa->status !== 'diterima' ? 'disabled' : '' }}
                                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 {{ $siswa->status !== 'diterima' ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}">
                                                <span class="text-[10px] font-bold {{ $siswa->status !== 'diterima' ? 'text-gray-400' : 'text-gray-700' }} uppercase">Konfirmasi</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('panitia.pendaftaran.show', $siswa) }}" 
                                               class="h-9 px-4 inline-flex items-center bg-indigo-50 text-indigo-600 rounded-xl text-xs font-bold hover:bg-indigo-100 transition-colors border border-indigo-100 shadow-sm">
                                                Detail
                                            </a>
                                            <button type="button" onclick="deleteSiswa({{ $siswa->id }})"
                                                    class="h-9 px-4 inline-flex items-center bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-colors border border-red-100 shadow-sm">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200 shadow-inner">
                                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-gray-500 font-medium tracking-tight">Tidak ada data siswa ditemukan</p>
                                </div>
                            @endforelse
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function deleteSiswa(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data siswa ini? Semua data pendaftaran dan akun user terkait akan ikut terhapus.')) {
                const form = document.getElementById('delete-form');
                form.action = `/panitia/pendaftaran/${id}`;
                form.submit();
            }
        }

        function confirmBulkDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus data siswa yang dipilih? Semua data pendaftaran dan akun user terkait akan ikut terhapus.')) {
                document.getElementById('bulk-delete-form').submit();
            }
        }

        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.siswa-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkDeleteBtn();
        });

        document.querySelectorAll('.siswa-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleBulkDeleteBtn);
        });

        function toggleBulkDeleteBtn() {
            const checkedCount = document.querySelectorAll('.siswa-checkbox:checked').length;
            const btn = document.getElementById('bulk-delete-btn');
            btn.style.display = checkedCount > 0 ? 'block' : 'none';
        }

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
    @endpush
</x-app-layout>
