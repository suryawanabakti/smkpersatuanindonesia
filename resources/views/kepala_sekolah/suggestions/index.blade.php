<x-app-layout>
    @section('header', 'Saran & Masukan')

    <div class="space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Kelola Saran</h2>
                <p class="text-sm text-gray-500">Kirim dan kelola saran masukan untuk Panitia dan Bendahara.</p>
            </div>
            <a href="{{ route('kepala_sekolah.suggestions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Saran Baru
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('kepala_sekolah.suggestions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" class="block w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Judul atau isi pesan...">
                    </div>
                </div>
                <div>
                    <label for="recipient_role" class="block text-sm font-medium text-gray-700 mb-1">Penerima</label>
                    <select name="recipient_role" id="recipient_role" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua</option>
                        <option value="panitia" {{ request('recipient_role') == 'panitia' ? 'selected' : '' }}>Panitia</option>
                        <option value="bendahara" {{ request('recipient_role') == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gray-50 text-gray-700 border border-gray-300 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Dibaca</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($suggestions as $suggestion)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($suggestion->title, 40) }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($suggestion->message, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($suggestion->recipient)
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($suggestion->recipient->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $suggestion->recipient->name }}</div>
                                                <div class="text-xs text-gray-500 capitalize">{{ $suggestion->recipient_role }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($suggestion->recipient_role ?? 'Semua') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($suggestion->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Sudah Dibaca
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Belum Dibaca
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $suggestion->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('kepala_sekolah.suggestions.show', $suggestion) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Detail</a>
                                    <form action="{{ route('kepala_sekolah.suggestions.destroy', $suggestion) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <p class="mt-2 text-sm font-medium">Belum ada saran yang dikirim.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4 p-4 bg-gray-50/30">
                @forelse ($suggestions as $suggestion)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base font-bold text-gray-900 truncate">{{ $suggestion->title }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($suggestion->is_read)
                                        <span class="px-2 py-0.5 text-[10px] uppercase font-bold rounded bg-green-100 text-green-700">Dibaca</span>
                                    @else
                                        <span class="px-2 py-0.5 text-[10px] uppercase font-bold rounded bg-yellow-100 text-yellow-700">Baru</span>
                                    @endif
                                    <span class="text-[10px] text-gray-400 font-medium tracking-wider uppercase">{{ $suggestion->created_at->format('d M, H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-xs text-gray-600 line-clamp-2">{{ $suggestion->message }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center min-w-0">
                                @if($suggestion->recipient)
                                    <div class="h-8 w-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs ring-2 ring-white">
                                        {{ substr($suggestion->recipient->name, 0, 1) }}
                                    </div>
                                    <div class="ml-2 min-w-0">
                                        <p class="text-[10px] font-bold text-gray-900 truncate">{{ $suggestion->recipient->name }}</p>
                                        <p class="text-[9px] text-indigo-500 uppercase font-bold tracking-tighter">{{ $suggestion->recipient_role }}</p>
                                    </div>
                                @else
                                    <span class="text-[10px] font-bold text-gray-400 italic">Universal {{ ucfirst($suggestion->recipient_role ?? 'Semua') }}</span>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('kepala_sekolah.suggestions.show', $suggestion) }}" 
                                   class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors">
                                    Detail
                                </a>
                                <form action="{{ route('kepala_sekolah.suggestions.destroy', $suggestion) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-gray-100 shadow-inner">
                        <svg class="h-10 w-10 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p class="text-gray-500 text-sm font-medium">Belum ada saran yang dikirim.</p>
                    </div>
                @endforelse
            </div>
            @if($suggestions->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $suggestions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
