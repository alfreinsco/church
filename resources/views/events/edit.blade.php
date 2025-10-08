<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Kegiatan</h1>
                    <p class="text-gray-600">{{ $event->name }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('events.update', $event->id) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama kegiatan">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kegiatan *</label>
                            <select id="type" name="type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('type') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kegiatan</option>
                                <option value="ibadah" {{ old('type', $event->type) == 'ibadah' ? 'selected' : '' }}>Ibadah</option>
                                <option value="retret" {{ old('type', $event->type) == 'retret' ? 'selected' : '' }}>Retret</option>
                                <option value="kkr" {{ old('type', $event->type) == 'kkr' ? 'selected' : '' }}>KKR</option>
                                <option value="bakti sosial" {{ old('type', $event->type) == 'bakti sosial' ? 'selected' : '' }}>Bakti Sosial</option>
                                <option value="konser" {{ old('type', $event->type) == 'konser' ? 'selected' : '' }}>Konser</option>
                                <option value="lainnya" {{ old('type', $event->type) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date?->format('Y-m-d')) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $event->start_time) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('start_time') border-red-500 @enderror">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('end_time') border-red-500 @enderror">
                            @error('end_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location and Details -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Lokasi & Detail</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('location') border-red-500 @enderror"
                                placeholder="Masukkan lokasi kegiatan">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="organizer_id" class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                            <select id="organizer_id" name="organizer_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('organizer_id') border-red-500 @enderror">
                                <option value="">Pilih Penanggung Jawab</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('organizer_id', $event->organizer_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('organizer_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Peserta</label>
                            <input type="number" id="max_participants" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" min="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('max_participants') border-red-500 @enderror"
                                placeholder="Masukkan maksimal peserta">
                            @error('max_participants')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="akan datang" {{ old('status', $event->status) == 'akan datang' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="sedang berlangsung" {{ old('status', $event->status) == 'sedang berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                <option value="selesai" {{ old('status', $event->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $event->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description and Notes -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi & Catatan</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                placeholder="Masukkan deskripsi kegiatan">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                placeholder="Masukkan catatan tambahan">{{ old('notes', $event->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
