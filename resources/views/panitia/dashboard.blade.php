<x-app-layout>
    @section('header', 'Dashboard')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Ringkasan Statistik</h2>
                <form action="{{ route('dashboard') }}" method="GET"
                    class="flex items-center space-x-2 bg-white p-2 rounded-lg shadow-sm">
                    <label for="year" class="text-sm font-medium text-gray-700">Tahun:</label>
                    <select name="year" id="year" onchange="this.form.submit()"
                        class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase mb-1">Total Pendaftar</div>
                    <div class="text-2xl text-gray-900 font-bold">{{ $totalSiswa }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium uppercase mb-1">Siswa Diterima</div>
                    <div class="text-2xl text-gray-900 font-bold">{{ $totalDiterima }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-yellow-500">
                    <div class="text-gray-500 text-sm font-medium uppercase mb-1">Status Pending</div>
                    <div class="text-2xl text-gray-900 font-bold">{{ $totalPending }}</div>
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8">
            @role('admin')
                <a href="{{ route('panitia.jadwal.index') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-indigo-500 hover:bg-indigo-50 transition-colors group">
                    <div class="text-gray-500 text-sm font-medium uppercase mb-1 group-hover:text-indigo-600"></div>
                    <div class="text-2xl text-indigo-600 font-bold flex items-center justify-between">
                        <span>Atur Jadwal Pendaftaran</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </a>
                @endrole
               @role('panitia')
<div class="max-w-xl bg-white rounded-2xl shadow-md border border-gray-100 p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
        📅 Jadwal PPDB
    </h2>

    <div class="space-y-3 text-sm text-gray-700">
        <div class="flex justify-between">
            <span class="font-medium text-gray-500">Nama Kegiatan</span>
            <span class="text-gray-900">{{ $jadwal->nama_kegiatan }}</span>
        </div>

        <div class="flex justify-between">
            <span class="font-medium text-gray-500">Tanggal Mulai</span>
            <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->translatedFormat('d F Y') }}</span>
        </div>

        <div class="flex justify-between">
            <span class="font-medium text-gray-500">Tanggal Selesai</span>
            <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_selesai)->translatedFormat('d F Y') }}</span>
        </div>

        @if($jadwal->keterangan)
        <div class="pt-3 border-t text-gray-600">
            <p class="font-medium mb-1">Keterangan</p>
            <p class="leading-relaxed">{{ $jadwal->keterangan }}</p>
        </div>
        @endif
    </div>
</div>
@endrole
           
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Pendaftar Terbaru</h3>
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Asal Sekolah</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentSiswa as $siswa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->asal_sekolah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800">
                                                {{ ucfirst($siswa->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $siswa->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('panitia.pendaftaran.show', $siswa) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="block md:hidden space-y-4">
                        @foreach ($recentSiswa as $siswa)
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900">{{ $siswa->nama_lengkap }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $siswa->asal_sekolah }}</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 text-[10px] uppercase tracking-wider font-bold rounded-lg bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800">
                                        {{ $siswa->status }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span
                                        class="text-xs text-gray-500">{{ $siswa->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('panitia.pendaftaran.show', $siswa) }}"
                                        class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('panitia.pendaftaran.index') }}"
                            class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
