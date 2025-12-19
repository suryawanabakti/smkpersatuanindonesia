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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold mb-4">Data Pribadi</h3>
                            <p><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}</p>
                            <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                            <p><strong>Asal Sekolah:</strong> {{ $siswa->asal_sekolah }}</p>
                            <p><strong>Email:</strong> {{ $siswa->email }}</p>
                            <p><strong>No HP:</strong> {{ $siswa->no_hp }}</p>
                            <p><strong>No HP Orang Tua:</strong> {{ $siswa->no_hp_orang_tua }}</p>
                            <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                            <p><strong>Jurusan Pilihan:</strong> {{ $siswa->jurusan_pilihan }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-4">Status Pendaftaran</h3>
                            <p class="mb-4">Current Status: 
                                <span class="font-bold text-{{ $siswa->status === 'diterima' ? 'green' : ($siswa->status === 'ditolak' ? 'red' : 'yellow') }}-600">
                                    {{ ucfirst($siswa->status) }}
                                </span>
                            </p>
                            
                            <form action="{{ route('panitia.pendaftaran.verify', $siswa) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Ubah Status</label>
                                    <select name="status" id="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="pending" {{ $siswa->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diterima" {{ $siswa->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="ditolak" {{ $siswa->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
