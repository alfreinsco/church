<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Jemaat</h1>
                    <p class="text-gray-600 mt-1">Daftarkan anggota jemaat baru</p>
                </div>
                <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                placeholder="Masukkan email">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                placeholder="Masukkan nomor telepon">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('birth_date') border-red-500 @enderror">
                            @error('birth_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('birth_place') border-red-500 @enderror"
                                placeholder="Masukkan tempat lahir">
                            @error('birth_place')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select id="gender" name="gender" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('gender') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">Status Pernikahan</label>
                            <select id="marital_status" name="marital_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('marital_status') border-red-500 @enderror">
                                <option value="belum menikah" {{ old('marital_status') == 'belum menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="menikah" {{ old('marital_status') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="cerai" {{ old('marital_status') == 'cerai' ? 'selected' : '' }}>Cerai</option>
                                <option value="janda" {{ old('marital_status') == 'janda' ? 'selected' : '' }}>Janda</option>
                                <option value="duda" {{ old('marital_status') == 'duda' ? 'selected' : '' }}>Duda</option>
                            </select>
                            @error('marital_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('occupation') border-red-500 @enderror"
                                placeholder="Masukkan pekerjaan">
                            @error('occupation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="education" class="block text-sm font-medium text-gray-700 mb-2">Pendidikan</label>
                            <input type="text" id="education" name="education" value="{{ old('education') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('education') border-red-500 @enderror"
                                placeholder="Masukkan pendidikan terakhir">
                            @error('education')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Alamat</h3>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('address') border-red-500 @enderror"
                            placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Religious Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Keagamaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="baptism_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Baptis</label>
                            <input type="date" id="baptism_date" name="baptism_date" value="{{ old('baptism_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('baptism_date') border-red-500 @enderror">
                            @error('baptism_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="baptism_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Baptis</label>
                            <input type="text" id="baptism_place" name="baptism_place" value="{{ old('baptism_place') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('baptism_place') border-red-500 @enderror"
                                placeholder="Masukkan tempat baptis">
                            @error('baptism_place')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sidi_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sidi</label>
                            <input type="date" id="sidi_date" name="sidi_date" value="{{ old('sidi_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('sidi_date') border-red-500 @enderror">
                            @error('sidi_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sidi_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Sidi</label>
                            <input type="text" id="sidi_place" name="sidi_place" value="{{ old('sidi_place') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('sidi_place') border-red-500 @enderror"
                                placeholder="Masukkan tempat sidi">
                            @error('sidi_place')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="marriage_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pernikahan</label>
                            <input type="date" id="marriage_date" name="marriage_date" value="{{ old('marriage_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('marriage_date') border-red-500 @enderror">
                            @error('marriage_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="marriage_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Pernikahan</label>
                            <input type="text" id="marriage_place" name="marriage_place" value="{{ old('marriage_place') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('marriage_place') border-red-500 @enderror"
                                placeholder="Masukkan tempat pernikahan">
                            @error('marriage_place')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status and Photo -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Foto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Keanggotaan</label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="meninggal" {{ old('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                            <input type="file" id="photo" name="photo" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('photo') border-red-500 @enderror">
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                        placeholder="Masukkan catatan tambahan">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>