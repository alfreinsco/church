<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pelayanan</h1>
                    <p class="text-gray-600">{{ $ministry->name }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('ministries.show', $ministry->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('ministries.update', $ministry->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelayanan
                                *</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $ministry->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama pelayanan">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori
                                *</label>
                            <select id="category" name="category" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('category') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="pemuridan"
                                    {{ old('category', $ministry->category) == 'pemuridan' ? 'selected' : '' }}>
                                    Pemuridan</option>
                                <option value="paduan suara"
                                    {{ old('category', $ministry->category) == 'paduan suara' ? 'selected' : '' }}>
                                    Paduan Suara</option>
                                <option value="sekolah minggu"
                                    {{ old('category', $ministry->category) == 'sekolah minggu' ? 'selected' : '' }}>
                                    Sekolah Minggu</option>
                                <option value="multimedia"
                                    {{ old('category', $ministry->category) == 'multimedia' ? 'selected' : '' }}>
                                    Multimedia</option>
                                <option value="kebersihan"
                                    {{ old('category', $ministry->category) == 'kebersihan' ? 'selected' : '' }}>
                                    Kebersihan</option>
                                <option value="keamanan"
                                    {{ old('category', $ministry->category) == 'keamanan' ? 'selected' : '' }}>Keamanan
                                </option>
                                <option value="lainnya"
                                    {{ old('category', $ministry->category) == 'lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="leader_id" class="block text-sm font-medium text-gray-700 mb-2">Pemimpin</label>
                            <select id="leader_id" name="leader_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('leader_id') border-red-500 @enderror">
                                <option value="">Pilih Pemimpin</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ old('leader_id', $ministry->leader_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('leader_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="aktif"
                                    {{ old('status', $ministry->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif"
                                    {{ old('status', $ministry->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Masukkan deskripsi pelayanan">{{ old('description', $ministry->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('ministries.show', $ministry->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
