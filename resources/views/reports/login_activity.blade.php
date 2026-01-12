<x-app-layout>
    @section('header', 'Login Activity')

    <div class="max-w-7xl mx-auto space-y-6">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-6 rounded-2xl shadow-sm border border-gray-100 gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Login History</h2>
                <p class="text-sm text-gray-500 mt-1">Track comprehensive user access logs and activity timestamps.</p>
            </div>
            <div class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Server Time: {{ now()->format('M d, H:i') }}</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                User Profile
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Email Address
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Last Login Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Timestamp
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-indigo-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-400">ID: #{{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-600">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $lastLogin = optional($user->last_login_at);
                                        $isRecent = $lastLogin && $lastLogin->diffInMinutes(now()) < 30;
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isRecent ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        @if($isRecent)
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                            Active Recently
                                        @else
                                            <span class="w-1.5 h-1.5 mr-1.5 bg-gray-400 rounded-full"></span>
                                            Offline
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700">
                                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                        </span>
                                        @if($user->last_login_at)
                                            <span class="text-xs text-gray-400">{{ $user->last_login_at->format('M d, Y • h:i A') }}</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-gray-500 text-sm font-medium">No login activity recorded yet.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden space-y-4 p-4 bg-gray-50/50">
                @forelse($users as $user)
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm transition-all duration-200 active:scale-[0.98]">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="h-12 w-12 flex-shrink-0 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-md underline-offset-4 ring-2 ring-white ring-offset-2 ring-offset-indigo-50">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-base font-bold text-gray-900 truncate">{{ $user->name }}</h4>
                                <p class="text-xs text-gray-500 truncate">ID: #{{ $user->id }} • {{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            @php
                                $lastLogin = optional($user->last_login_at);
                                $isRecent = $lastLogin && $lastLogin->diffInMinutes(now()) < 30;
                            @endphp
                            <div class="flex items-center">
                                <span class="relative flex h-2 w-2 mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isRecent ? 'bg-green-400' : 'bg-gray-400' }} opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 {{ $isRecent ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                </span>
                                <span class="text-xs font-semibold {{ $isRecent ? 'text-green-700' : 'text-gray-500' }}">
                                    {{ $isRecent ? 'Online' : 'Offline' }}
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-gray-700">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                </p>
                                @if($user->last_login_at)
                                    <p class="text-[10px] text-gray-400 mt-0.5">{{ $user->last_login_at->format('d M, H:i') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-100 shadow-inner">
                        <svg class="h-10 w-10 text-gray-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500 text-sm font-medium">No login activity recorded yet.</p>
                    </div>
                @endforelse
            </div>

            @if($users->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
