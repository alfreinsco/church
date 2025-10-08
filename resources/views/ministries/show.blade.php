<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $ministry->name }}</h1>
                    <p class="text-gray-600">{{ ucfirst($ministry->category) }} • {{ ucfirst($ministry->status) }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('ministries.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    @can('edit ministries')
                        <a href="{{ route('ministries.edit', $ministry->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17l-2.83-2.828L11 17z">
                                </path>
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pelayanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Pelayanan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ministry->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Kategori</label>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($ministry->category) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Pemimpin</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if ($ministry->leader)
                                    {{ $ministry->leader->name }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $ministry->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($ministry->status) }}
                            </span>
                        </div>
                    </div>
                    @if ($ministry->description)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-500">Deskripsi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ministry->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Members -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Anggota Pelayanan</h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800">
                            {{ $ministry->members->count() }} anggota
                        </span>
                    </div>

                    @if ($ministry->members->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($ministry->members as $member)
                                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if ($member->photo)
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ asset($member->photo) }}" alt="{{ $member->name }}">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-full bg-cyan-600 flex items-center justify-center">
                                                <span
                                                    class="text-white font-medium text-sm">{{ substr($member->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $member->name }}</p>
                                        <p class="text-sm text-gray-500">{{ ucfirst($member->gender) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <p class="text-gray-500">Belum ada anggota dalam pelayanan ini</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- System Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Sistem</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dibuat Oleh</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ministry->createdBy->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $ministry->created_at->format('d F Y H:i') }}</p>
                        </div>
                        @if ($ministry->updatedBy)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Diperbarui Oleh</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $ministry->updatedBy->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Diperbarui</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $ministry->updated_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                    <div class="space-y-3">
                        @can('edit ministries')
                            <a href="{{ route('ministries.edit', $ministry->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17l-2.83-2.828L11 17z">
                                    </path>
                                </svg>
                                Edit Data
                            </a>
                        @endcan
                        @can('delete ministries')
                            <form action="{{ route('ministries.destroy', $ministry->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelayanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
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
