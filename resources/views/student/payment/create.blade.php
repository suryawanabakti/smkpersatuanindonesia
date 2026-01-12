<x-app-layout>
    @section('header', 'Buat Pembayaran Baru')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Form Pembayaran</h2>

            @if(session('error'))
                <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('student.payment.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="attributes[]" value="topi" data-price="{{ $schoolInformation->price }}" class="attribute-checkbox h-5 w-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                            <div class="ml-3">
                                <span class="block text-sm font-semibold text-gray-900">Atribut</span>
                                <span class="block text-xs text-gray-500">Rp {{ number_format($schoolInformation->price, 0, ',', '.') }}</span>
                            </div>
                        </label>
                        
                    </div>
                    @error('attributes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Total Pembayaran (Rp)</label>
                    <input type="number" name="amount" id="amount" class="mt-1 block w-full px-4 py-3 rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-bold text-lg" readonly required>
                    <input type="hidden" name="description" value="Pembayaran Atribut PPDB">
                </div>

                <div class="flex justify-end">
                    <button type="submit" id="submit-btn" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transform transition-all hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.attribute-checkbox');
            const amountInput = document.getElementById('amount');
            const submitBtn = document.getElementById('submit-btn');

            function calculateTotal() {
                let total = 0;
                let count = 0;
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        total += parseInt(cb.dataset.price);
                        count++;
                    }
                });
                amountInput.value = total;
                submitBtn.disabled = count === 0;
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', calculateTotal);
            });
        });
    </script>
</x-app-layout>
