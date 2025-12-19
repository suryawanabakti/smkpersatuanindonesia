<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-blue-800 mb-2">Total Pendapatan</h3>
                        <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold mb-4">Pendapatan Per Bulan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pendapatanPerBulan as $data)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $data->months }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($data->sums, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
