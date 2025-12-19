<x-guest-layout>
    <div class="min-h-screen flex w-full">
        <!-- Left Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white">
            <div class="w-full max-w-md space-y-10">
                <div class="space-y-2">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Welcome back</h2>
                    <p class="text-gray-500 text-sm">Please enter your details to sign in.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                        <input id="email" class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@company.com" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                        <input id="password" class="block w-full px-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm placeholder-gray-400 transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <!-- 
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif 
                        -->
                    </div>

                    <div class="pt-2">
                        <button type="submit" style="background-color: #4f46e5; color: white;" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-500/20 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
                            Sign In
                        </button>
                    </div>
                </form>
            
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">FKUH System</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden lg:flex w-1/2 relative bg-gray-900">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/90 to-purple-900/90 z-10 mix-blend-multiply"></div>
            <!-- Placeholder Medical/University Image -->
            <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Medical Background">
            
            <div class="relative z-20 flex flex-col justify-end p-24 text-white">
                <blockquote class="space-y-6">
                    <div class="text-lg font-medium opacity-80">
                        &ldquo;Fakultas Kedokteran Universitas Hasanuddin committed to excellence in medical education, research, and community service.&rdquo;
                    </div>
                    <footer class="text-sm font-bold text-indigo-200">
                        Academic System Portal
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
</x-guest-layout>
