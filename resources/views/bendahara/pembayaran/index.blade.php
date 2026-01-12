<x-app-layout>
    @section('header', 'Data Pembayaran')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filter Section -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <form method="GET" action="{{ route('bendahara.pembayaran.index') }}">
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Cari</label>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Nama / Order ID"
                                        class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                                    <select name="jurusan"
                                        class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                        <option value="">Semua Jurusan</option>
                                        <option value="TJKT" {{ request('jurusan') == 'TJKT' ? 'selected' : '' }}>Teknik
                                            Komputer Jaringan</option>
                                        <option value="TKRO" {{ request('jurusan') == 'TKRO' ? 'selected' : '' }}>Teknik
                                            Kendaraan Ringan Otomotif</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status"
                                        class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>
                                            Failed</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                                        class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                        class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors">
                                </div>
                                <div class="flex items-end gap-2">
                                    <button type="submit"
                                        class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filter</button>
                                    <a href="{{ route('bendahara.pembayaran.export', request()->all()) }}"
                                        class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-center">Export
                                        Excel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mb-4 flex gap-2">
                        <button type="button" id="bulk-delete-btn" style="display: none;"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                            onclick="confirmBulkDelete()">Hapus Terpilih</button>
                    </div>

                    <form id="bulk-delete-form" action="{{ route('bendahara.pembayaran.bulk_delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Siswa</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Update Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-right">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="checkbox" name="ids[]" value="{{ $payment->id }}" class="payment-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->user?->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->order_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp
                                                {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-800">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('d M Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <select name="status" onchange="updateStatus(this, '{{ $payment->id }}')"
                                                    class="text-xs rounded-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid
                                                    </option>
                                                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>
                                                        Failed</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('bendahara.pembayaran.show', $payment) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="deletePayment('{{ $payment->id }}')">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="block md:hidden space-y-4 p-4 bg-gray-50/50 rounded-xl">
                            @forelse ($payments as $payment)
                                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <input type="checkbox" name="ids[]" value="{{ $payment->id }}" 
                                                       class="payment-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <h4 class="text-base font-bold text-gray-900 truncate">{{ $payment->user?->name ?? 'N/A' }}</h4>
                                            </div>
                                            <p class="text-xs text-gray-500 font-medium">Order ID: {{ $payment->order_id }}</p>
                                        </div>
                                        <span class="px-2.5 py-1 text-[10px] uppercase tracking-wider font-extrabold rounded-lg bg-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-100 text-{{ $payment->status === 'paid' ? 'green' : ($payment->status === 'expired' ? 'red' : 'yellow') }}-800 shadow-sm">
                                            {{ $payment->status }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col gap-3 mb-5">
                                        <div class="flex items-center justify-between bg-gray-50/50 p-3 rounded-xl border border-gray-50">
                                            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jumlah</span>
                                            <span class="text-sm font-black text-indigo-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between px-3">
                                            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Tanggal</span>
                                            <span class="text-xs font-medium text-gray-700">{{ $payment->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-4 pt-4 border-t border-gray-50">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Update Status</span>
                                            <select name="status" onchange="updateStatus(this, '{{ $payment->id }}')"
                                                class="text-xs font-bold rounded-lg border-gray-200 bg-gray-50 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-1.5 px-3">
                                                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div class="flex gap-2 w-full">
                                            <a href="{{ route('bendahara.pembayaran.show', $payment) }}" 
                                               class="flex-1 h-10 inline-flex items-center justify-center bg-indigo-50 text-indigo-600 rounded-xl text-xs font-bold hover:bg-indigo-100 transition-colors border border-indigo-100">
                                                Detail
                                            </a>
                                            <button type="button" onclick="deletePayment('{{ $payment->id }}')"
                                                    class="flex-1 h-10 inline-flex items-center justify-center bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-colors border border-red-100">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200">
                                    <p class="text-gray-500 font-medium">Tidak ada data pembayaran</p>
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
    
    <form id="update-form" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="update-status-input">
    </form>

    <script>
        function deletePayment(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pembayaran ini?')) {
                const form = document.getElementById('delete-form');
                form.action = `/bendahara/pembayaran/${id}`;
                form.submit();
            }
        }

        function updateStatus(select, id) {
            const form = document.getElementById('update-form');
            form.action = `/bendahara/pembayaran/${id}`;
            document.getElementById('update-status-input').value = select.value;
            form.submit();
        }

        function confirmBulkDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus pembayaran yang dipilih?')) {
                document.getElementById('bulk-delete-form').submit();
            }
        }

        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.payment-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkDeleteBtn();
        });

        document.querySelectorAll('.payment-checkbox').forEach(cb => {
            cb.addEventListener('change', toggleBulkDeleteBtn);
        });

        function toggleBulkDeleteBtn() {
            const checkedCount = document.querySelectorAll('.payment-checkbox:checked').length;
            const btn = document.getElementById('bulk-delete-btn');
            btn.style.display = checkedCount > 0 ? 'block' : 'none';
        }
    </script>
    @endpush
</x-app-layout>
