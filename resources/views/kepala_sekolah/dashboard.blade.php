<x-app-layout>
    @section('header', 'Dashboard')

    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <!-- Welcome Card -->
            <div class="flex-1 bg-gradient-to-r from-indigo-500 to-violet-600 rounded-2xl shadow-lg p-8 text-white">
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h2>
                <p class="text-indigo-100">Kelola dan pantau sistem PPDB sekolah Anda (Tahun {{ $selectedYear }})</p>
            </div>

            <!-- Year Filter Form -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full flex items-center">
                <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col gap-2">
                    <label for="year" class="text-sm font-semibold text-gray-700">Filter Tahun Pendaftaran</label>
                    <div class="flex items-center gap-2">
                        <select name="year" id="year"
                            class="rounded-xl border-gray-200 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 min-w-[120px]">
                            @foreach ($availableYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Siswa -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Pendaftar</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalSiswa }}</p>
                    </div>
                    <div class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Diterima</p>
                        <p class="text-3xl font-bold text-green-600">{{ $totalDiterima }}</p>
                    </div>
                    <div class="h-12 w-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $totalPending }}</p>
                    </div>
                    <div class="h-12 w-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pendaftaran Sukses per Jurusan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendaftaran Sukses per Jurusan</h3>
                <canvas id="registrationsChart"></canvas>
            </div>
            <!-- Statistik Pendaftaran per Tahun -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pendaftaran per Tahun (TJKT vs TKRO)</h3>
                <canvas id="yearlyChart"></canvas>
            </div>
            <!-- Distribusi Siswa per Jurusan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Siswa per Jurusan</h3>
                <canvas id="distributionChart"></canvas>
            </div>

            <!-- Pendapatan Bulanan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendapatan Bulanan ({{ $selectedYear }})</h3>
                <canvas id="incomeChart"></canvas>
            </div>


        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Shared Colors
                const colors = [
                    'red', // Merah
                    'yellow', // Kuning
                ];

                const borders = [
                    'rgba(239, 68, 68, 1)', // Merah
                    'rgba(245, 158, 11, 1)', // Kuning
                ];

                // 1. Registrations by Major (Bar)
                const regCtx = document.getElementById('registrationsChart').getContext('2d');
                new Chart(regCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($registrationsByMajor->keys()) !!},
                        datasets: [{
                            label: 'Jumlah Diterima',
                            data: {!! json_encode($registrationsByMajor->values()) !!},
                            backgroundColor: colors,
                            borderColor: borders,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });

                // 2. Student Distribution (Doughnut)
                const distCtx = document.getElementById('distributionChart').getContext('2d');
                new Chart(distCtx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($studentsByMajor->keys()) !!},
                        datasets: [{
                            data: {!! json_encode($studentsByMajor->values()) !!},
                            backgroundColor: colors,
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                    }
                });

                // 3. Monthly Income (Line/Bar)
                const incomeCtx = document.getElementById('incomeChart').getContext('2d');
                const months = ['Jan', 'Feb', 'Mar', 'Apr', ' Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                new Chart(incomeCtx, {
                    type: 'bar', // Requested Bar Chart
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: {!! json_encode(array_values($incomeData)) !!},
                            backgroundColor: 'rgba(79, 70, 229, 0.6)',
                            borderColor: 'rgba(79, 70, 229, 1)',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }
                        }
                    }
                });

                // 4. Yearly Registrations (Grouped Bar)
                const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
                new Chart(yearlyCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($yearlyLabels) !!},
                        datasets: [{
                                label: 'TJKT',
                                data: {!! json_encode($yearlyTJKT) !!},
                                backgroundColor: 'red', // Merah
                                borderColor: 'rgba(239, 68, 68, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'TKRO',
                                data: {!! json_encode($yearlyTKRO) !!},
                                backgroundColor: 'yellow', // Kuning
                                borderColor: 'rgba(245, 158, 11, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NISN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentSiswa as $siswa)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $siswa->nama_lengkap }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $siswa->nisn }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $siswa->jurusan_pilihan }}</div>
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
                                    {{ $siswa->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada pendaftaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('kepala_sekolah.laporan_ppdb.index') }}"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all hover:border-indigo-200 group">
                <div class="flex items-center">
                    <div
                        class="h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                            Laporan PPDB</h4>
                        <p class="text-sm text-gray-500">Lihat laporan lengkap pendaftaran</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('users.index') }}"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all hover:border-indigo-200 group">
                <div class="flex items-center">
                    <div
                        class="h-12 w-12 bg-violet-100 rounded-xl flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                        <svg class="h-6 w-6 text-violet-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-gray-900 group-hover:text-violet-600 transition-colors">
                            Kelola Pengguna</h4>
                        <p class="text-sm text-gray-500">Manajemen pengguna sistem</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
