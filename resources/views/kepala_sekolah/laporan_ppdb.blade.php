<x-app-layout>
    @section('header', 'Laporan PPDB')

    <div class="space-y-6">
        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalSiswa }}</p>
                    </div>
                    <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Diterima</p>
                        <p class="text-2xl font-bold text-green-600">{{ $totalDiterima }}</p>
                    </div>
                    <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pending</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $totalPending }}</p>
                    </div>
                    <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Export -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full flex items-center">
            <form method="GET" action="{{ route('kepala_sekolah.laporan_ppdb.index') }}" class="flex flex-col gap-2">

                {{-- Label --}}
                <label for="year" class="text-sm font-semibold text-gray-700">
                    Filter Tahun Pendaftaran
                </label>

                {{-- Select + Button --}}
                <div class="flex items-center gap-2">

                    {{-- Tahun --}}
                    <select name="year" id="year"
                        class="rounded-xl border-gray-200 text-gray-700
                           focus:ring-indigo-500 focus:border-indigo-500
                           min-w-[140px]">
                        <option value="">Semua Tahun</option>
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Filter Button --}}
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-xl
                           hover:bg-indigo-700 transition-colors shadow-sm">
                        Filter
                    </button>

                    {{-- Reset Button --}}
                    @if (request()->has('year'))
                        <a href="{{ route('kepala_sekolah.laporan_ppdb.index') }}"
                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl
                          hover:bg-gray-200 transition-colors shadow-sm">
                            Reset
                        </a>
                    @endif

                </div>
            </form>
        </div>


        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NISN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asal Sekolah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. HP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $siswa->nama_lengkap }}</div>
                                    <div class="text-sm text-gray-500">{{ $siswa->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $siswa->nisn }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $siswa->asal_sekolah }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $siswa->jurusan_pilihan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $siswa->no_hp }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($siswa->status === 'diterima')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Diterima
                                        </span>
                                    @elseif($siswa->status === 'ditolak')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $siswa->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <svg class="h-12 w-12 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-lg font-medium">Tidak ada data pendaftaran</p>
                                        <p class="text-sm">Belum ada siswa yang mendaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4 p-4 bg-gray-50/50">
                @forelse($siswas as $siswa)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-bold text-gray-900 truncate">{{ $siswa->nama_lengkap }}</h3>
                                <p class="text-xs text-gray-500 truncate">{{ $siswa->email }}</p>
                            </div>
                            @if ($siswa->status === 'diterima')
                                <span
                                    class="px-2 py-1 text-[10px] uppercase font-bold rounded-lg bg-green-100 text-green-800">Diterima</span>
                            @elseif($siswa->status === 'ditolak')
                                <span
                                    class="px-2 py-1 text-[10px] uppercase font-bold rounded-lg bg-red-100 text-red-800">Ditolak</span>
                            @else
                                <span
                                    class="px-2 py-1 text-[10px] uppercase font-bold rounded-lg bg-yellow-100 text-yellow-800">Pending</span>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">NISN</p>
                                <p class="text-xs font-semibold text-gray-900 mt-1">{{ $siswa->nisn }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jurusan</p>
                                <p class="text-xs font-semibold text-gray-900 mt-1">{{ $siswa->jurusan_pilihan }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-gray-50">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-gray-500 uppercase font-medium">Asal Sekolah</span>
                                <span
                                    class="text-xs font-medium text-gray-700">{{ Str::limit($siswa->asal_sekolah, 25) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-gray-500 uppercase font-medium">No. HP</span>
                                <span class="text-xs font-medium text-gray-700">{{ $siswa->no_hp }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] text-gray-500 uppercase font-medium">Terdaftar</span>
                                <span
                                    class="text-xs font-medium text-gray-400">{{ $siswa->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-gray-200">
                        <p class="text-sm text-gray-500 font-medium">Tidak ada data pendaftaran</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($siswas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $siswas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
