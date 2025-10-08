<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $event->name }}</h1>
                    <p class="text-gray-600">{{ ucfirst($event->type) }} • {{ ucfirst($event->status) }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    @can('edit events')
                        <a href="{{ route('events.edit', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17l-2.83-2.828L11 17z"></path>
                            </svg>
                            Edit
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kegiatan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Kegiatan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kegiatan</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($event->type) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Mulai</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->start_date ? $event->start_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Selesai</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->end_date ? $event->end_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Waktu Mulai</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->start_time ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Waktu Selesai</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->end_time ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Lokasi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->location ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $event->status == 'akan datang' ? 'bg-blue-100 text-blue-800' : 
                                   ($event->status == 'sedang berlangsung' ? 'bg-green-100 text-green-800' : 
                                   ($event->status == 'selesai' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                    </div>
                    @if($event->description)
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-500">Deskripsi</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $event->description }}</p>
                    </div>
                    @endif
                </div>

                <!-- Participants -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Peserta Kegiatan</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                            {{ $event->registrations->count() }} pendaftar
                        </span>
                    </div>
                    
                    @if($event->registrations->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($event->registrations as $registration)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($registration->member->photo)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($registration->member->photo) }}" alt="{{ $registration->member->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-cyan-600 flex items-center justify-center">
                                                <span class="text-white font-medium text-sm">{{ substr($registration->member->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $registration->member->name }}</p>
                                        <p class="text-sm text-gray-500">{{ ucfirst($registration->member->gender) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500">Belum ada peserta yang mendaftar</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Event Details -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Kegiatan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Penanggung Jawab</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if ($event->organizer)
                                    {{ $event->organizer->name }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Maksimal Peserta</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->max_participants ?: 'Tidak terbatas' }}</p>
                        </div>
                        @if($event->notes)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Catatan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- System Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dibuat Oleh</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->createdBy->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->created_at->format('d F Y H:i') }}</p>
                        </div>
                        @if($event->updatedBy)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Diperbarui Oleh</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->updatedBy->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Diperbarui</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $event->updated_at->format('d F Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                    <div class="space-y-3">
                        @can('edit events')
                            <a href="{{ route('events.edit', $event->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17l-2.83-2.828L11 17z"></path>
                                </svg>
                                Edit Data
                            </a>
                        @endcan
                        @can('delete events')
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Data
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
