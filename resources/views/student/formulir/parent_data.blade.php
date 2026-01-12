<x-app-layout>
    @section('header', 'Data Orang Tua')

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
            <div class="p-8 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Informasi Orang Tua / Wali</h2>
                        <p class="mt-1 text-sm text-gray-500">Data ini diambil dari formulir pendaftaran yang telah Anda isi.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 border border-gray-100">
                    <dl class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-1">Nama Orang Tua / Wali</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $siswa->nama_wali }}</dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-1">No. HP Orang Tua</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $siswa->no_hp_orang_tua }}</dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-1">Pekerjaan</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $siswa->pekerjaan_wali }}</dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-1">Penghasilan Per Bulan</dt>
                            <dd class="text-lg font-medium text-gray-900 text-green-700">Rp {{ $siswa->penghasilan_wali }}</dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-1">Alamat Lengkap</dt>
                            <dd class="text-lg font-medium text-gray-900 leading-relaxed">{{ $siswa->alamat_wali }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-10 flex justify-end gap-3">
                    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Kembali ke Dashboard
                    </a>
                    <a href="{{ route('student.formulir.edit') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        Edit Data (Melalui Formulir)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
