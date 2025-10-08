<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pengeluaran</h1>
                    <p class="text-gray-600 mt-1">Edit data pengeluaran</p>
                </div>
                <a href="{{ route('finances.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form action="{{ route('finances.update-expense', $expense->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Pengeluaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="description" id="description" value="{{ old('description', $expense->description) }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('description') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi pengeluaran">
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" 
                                class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('amount') border-red-500 @enderror"
                                placeholder="0" min="0" step="100">
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('category') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="operasional" {{ old('category', $expense->category) == 'operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="listrik" {{ old('category', $expense->category) == 'listrik' ? 'selected' : '' }}>Listrik</option>
                            <option value="air" {{ old('category', $expense->category) == 'air' ? 'selected' : '' }}>Air</option>
                            <option value="telepon" {{ old('category', $expense->category) == 'telepon' ? 'selected' : '' }}>Telepon</option>
                            <option value="internet" {{ old('category', $expense->category) == 'internet' ? 'selected' : '' }}>Internet</option>
                            <option value="pemeliharaan" {{ old('category', $expense->category) == 'pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                            <option value="perbaikan" {{ old('category', $expense->category) == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                            <option value="pembelian" {{ old('category', $expense->category) == 'pembelian' ? 'selected' : '' }}>Pembelian</option>
                            <option value="transportasi" {{ old('category', $expense->category) == 'transportasi' ? 'selected' : '' }}>Transportasi</option>
                            <option value="lainnya" {{ old('category', $expense->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="date" id="date" value="{{ old('date', $expense->date->format('Y-m-d')) }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('date') border-red-500 @enderror">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                            Metode Pembayaran
                        </label>
                        <select name="payment_method" id="payment_method" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            <option value="">Pilih Metode</option>
                            <option value="tunai" {{ old('payment_method', $expense->payment_method) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="transfer" {{ old('payment_method', $expense->payment_method) == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="cek" {{ old('payment_method', $expense->payment_method) == 'cek' ? 'selected' : '' }}>Cek</option>
                            <option value="kartu_kredit" {{ old('payment_method', $expense->payment_method) == 'kartu_kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Receipt Number -->
                    <div>
                        <label for="receipt_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Kwitansi
                        </label>
                        <input type="text" name="receipt_number" id="receipt_number" value="{{ old('receipt_number', $expense->receipt_number) }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('receipt_number') border-red-500 @enderror"
                            placeholder="Masukkan nomor kwitansi (opsional)">
                        @error('receipt_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan
                    </label>
                    <textarea name="notes" id="notes" rows="3" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                        placeholder="Tambahkan catatan pengeluaran (opsional)">{{ old('notes', $expense->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('finances.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Pengeluaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
