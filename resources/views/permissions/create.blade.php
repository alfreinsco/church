<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Permission</h1>
                    <p class="text-gray-600 mt-1">Buat permission baru untuk sistem</p>
                </div>
                <a href="{{ route('permissions.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Permission Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Permission <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama permission (contoh: view users, create users, edit users, delete users)"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Gunakan format: action resource (contoh: view users, create roles, edit permissions)
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('permissions.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Simpan Permission
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">Panduan Naming Permission</h3>
            <div class="space-y-2 text-sm text-blue-800">
                <p><strong>Format yang disarankan:</strong> action resource</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <h4 class="font-medium mb-2">Actions yang umum digunakan:</h4>
                        <ul class="space-y-1">
                            <li>• view - Melihat data</li>
                            <li>• create - Membuat data baru</li>
                            <li>• edit - Mengedit data</li>
                            <li>• delete - Menghapus data</li>
                            <li>• manage - Mengelola semua operasi</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-medium mb-2">Resources yang umum:</h4>
                        <ul class="space-y-1">
                            <li>• users - Pengguna</li>
                            <li>• roles - Role</li>
                            <li>• permissions - Permission</li>
                            <li>• members - Anggota jemaat</li>
                            <li>• events - Acara</li>
                            <li>• finances - Keuangan</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-blue-100 rounded-lg">
                    <p><strong>Contoh permission yang baik:</strong></p>
                    <ul class="mt-1 space-y-1">
                        <li>• view users, create users, edit users, delete users</li>
                        <li>• view roles, create roles, edit roles, delete roles</li>
                        <li>• manage permissions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
