<x-app-layout>
    @section('header', 'Buat Pembayaran Baru')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Form Pembayaran SPP</h2>

            @if(session('error'))
                <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('student.payment.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Pembayaran</label>
                    <select name="description" id="description" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-3 px-4" required>
                        <option value="">-- Pilih Jenis Pembayaran --</option>
                        <option value="SPP Januari 2025">SPP Januari 2025</option>
                        <option value="SPP Februari 2025">SPP Februari 2025</option>
                        <option value="SPP Maret 2025">SPP Maret 2025</option>
                        <option value="Uang Pangkal">Uang Pangkal</option>
                        <option value="Uang Seragam">Uang Seragam</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pembayaran (Rp)</label>
                    <input type="number" name="amount" id="amount" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm py-3 px-4 text-lg" placeholder="Contoh: 150000" min="10000" required>
                    <p class="text-xs text-gray-500 mt-1">Minimal pembayaran Rp 10.000</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transform transition-all hover:-translate-y-0.5">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
