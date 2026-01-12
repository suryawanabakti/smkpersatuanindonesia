<x-app-layout>
    @section('header', 'Saran Masuk')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($suggestions as $suggestion)
                                <tr class="hover:bg-gray-50 transition-colors {{ $suggestion->is_read ? '' : 'bg-indigo-50/30' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($suggestion->sender->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $suggestion->sender->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ Str::limit($suggestion->title, 40) }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($suggestion->message, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $suggestion->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        @if($suggestion->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Dibaca
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                Baru
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('my_suggestions.show', $suggestion) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="mt-2 text-sm font-medium">Belum ada saran masuk.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="block md:hidden space-y-4 p-4">
                    @forelse ($suggestions as $suggestion)
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-200 {{ $suggestion->is_read ? '' : 'ring-2 ring-indigo-500/20 bg-indigo-50/10' }}">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 font-bold shadow-inner">
                                        {{ substr($suggestion->sender->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 truncate">{{ $suggestion->sender->name }}</h4>
                                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">{{ $suggestion->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                @if(!$suggestion->is_read)
                                    <span class="flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-indigo-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-4">
                                <h5 class="text-sm font-bold text-gray-900 mb-1">{{ $suggestion->title }}</h5>
                                <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">{{ $suggestion->message }}</p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-[10px] font-bold uppercase tracking-widest {{ $suggestion->is_read ? 'text-gray-400' : 'text-indigo-600' }}">
                                    {{ $suggestion->is_read ? '✓ Dibaca' : '● Baru' }}
                                </span>
                                <a href="{{ route('my_suggestions.show', $suggestion) }}" 
                                   class="px-3 py-1.5 bg-white text-indigo-600 border border-indigo-100 rounded-lg text-xs font-bold hover:bg-indigo-50 transition-colors shadow-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                             <svg class="mx-auto h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                             <p class="mt-2 text-xs font-medium text-gray-400">Belum ada saran masuk.</p>
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
    </div>
</x-app-layout>
