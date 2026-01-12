<x-app-layout>
    @section('header', 'Buat Saran Baru')

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-100">
                    <form action="{{ route('kepala_sekolah.suggestions.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Recipient Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penerima Saran</label>
                            
                            <div class="space-y-4">
                                <!-- Option 1: Broadcast to Role -->
                        

                                <!-- Option 2: Specific User -->
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="type_specific" name="recipient_type" value="specific" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked onchange="toggleRecipientInput()">
                                    </div>
                                    <div class="ml-3 text-sm w-full">
                                        <label for="type_specific" class="font-medium text-gray-700">Pilih User Spesifik</label>
                                        <div class="mt-2" id="specific_user_input">
                                            <select name="recipient_id" id="recipient_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                <option value="" disabled selected>Pilih User...</option>
                                                <optgroup label="Panitia">
                                                    @foreach($panitiaUsers as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} (Panitia)</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Bendahara">
                                                    @foreach($bendaharaUsers as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }} (Bendahara)</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('recipient_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @error('recipient_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Saran</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" placeholder="Contoh: Perbaikan Alur Pendaftaran" value="{{ old('title') }}" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Isi Saran</label>
                            <textarea name="message" id="message" rows="4" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" placeholder="Tuliskan saran dan masukan Anda secara detail..." required>{{ old('message') }}</textarea>
                            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end pt-4 border-t border-gray-100">
                            <a href="{{ route('kepala_sekolah.suggestions.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kirim Saran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleRecipientInput() {
            const isSpecific = document.getElementById('type_specific').checked;
            const specificInput = document.getElementById('specific_user_input');
            const select = document.getElementById('recipient_id');
            
            if (isSpecific) {
                specificInput.classList.remove('opacity-50', 'pointer-events-none');
                select.required = true;
            } else {
                specificInput.classList.add('opacity-50', 'pointer-events-none');
                select.required = false;
                select.value = "";
            }
        }
    </script>
</x-app-layout>
