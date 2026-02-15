<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal PPDB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold">Daftar Jadwal</h3>
                        <a href="{{ route('panitia.jadwal.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Jadwal
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->nama_kegiatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tanggal_mulai->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->tanggal_selesai->format('d M Y') }}</td>
                                        <td class="px-6 py-4">{{ $jadwal->keterangan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('panitia.jadwal.edit', $jadwal) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                            <form action="{{ route('panitia.jadwal.destroy', $jadwal) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="block md:hidden space-y-4">
                        @foreach ($jadwals as $jadwal)
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="text-base font-bold text-gray-900">{{ $jadwal->nama_kegiatan }}</h4>
                                        <p class="text-xs text-indigo-600 font-medium">
                                            {{ $jadwal->tanggal_mulai->format('d M Y') }} - {{ $jadwal->tanggal_selesai->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-4 text-sm">
                                    <p class="text-gray-500 text-xs mb-1">Keterangan</p>
                                    <p class="text-gray-700">{{ $jadwal->keterangan }}</p>
                                </div>

                                <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-2">
                                    <a href="{{ route('panitia.jadwal.edit', $jadwal) }}" 
                                       class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('panitia.jadwal.destroy', $jadwal) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
