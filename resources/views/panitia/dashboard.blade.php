<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Panitia PPDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Total Pendaftar</div>
                    <div class="text-3xl text-blue-600 font-bold">{{ $totalSiswa }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Diterima</div>
                    <div class="text-3xl text-green-600 font-bold">{{ $totalDiterima }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Ditolak</div>
                    <div class="text-3xl text-red-600 font-bold">{{ $totalDitolak }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold mb-2">Pending</div>
                    <div class="text-3xl text-yellow-600 font-bold">{{ $totalPending }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Pendaftar Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentSiswa as $siswa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nama_lengkap }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->asal_sekolah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-100 text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-800">
                                                {{ ucfirst($siswa->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('panitia.pendaftaran.show', $siswa) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('panitia.pendaftaran.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
