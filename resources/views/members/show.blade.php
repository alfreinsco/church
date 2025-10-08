<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 h-16 w-16">
                        @if ($member->photo)
                            <img class="h-16 w-16 rounded-full object-cover" src="{{ asset($member->photo) }}" alt="{{ $member->name }}">
                        @else
                            <div class="h-16 w-16 rounded-full bg-cyan-600 flex items-center justify-center">
                                <span class="text-white font-medium text-2xl">{{ substr($member->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $member->name }}</h1>
                        <p class="text-gray-600">{{ ucfirst($member->gender) }} • {{ ucfirst($member->status) }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    @can('edit members')
                        <a href="{{ route('members.edit', $member->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
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
            <!-- Personal Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($member->gender) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->birth_date ? $member->birth_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat Lahir</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->birth_place ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status Pernikahan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($member->marital_status) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Pekerjaan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->occupation ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Pendidikan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->education ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status Keanggotaan</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $member->status == 'aktif' ? 'bg-green-100 text-green-800' : 
                                   ($member->status == 'tidak aktif' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($member->status == 'pindah' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->email ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->phone ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->address ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Religious Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Keagamaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Baptis</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->baptism_date ? $member->baptism_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat Baptis</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->baptism_place ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Sidi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->sidi_date ? $member->sidi_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat Sidi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->sidi_place ?: '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Pernikahan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->marriage_date ? $member->marriage_date->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat Pernikahan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->marriage_place ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                @if($member->notes)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Catatan</h3>
                    <p class="text-sm text-gray-900">{{ $member->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Family Information -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Keluarga</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Keluarga</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->family ? $member->family->family_name : '-' }}</p>
                        </div>
                        @if($member->father)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Ayah</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->father->name }}</p>
                        </div>
                        @endif
                        @if($member->mother)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Ibu</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->mother->name }}</p>
                        </div>
                        @endif
                        @if($member->spouse)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Pasangan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->spouse->name }}</p>
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
                            <p class="mt-1 text-sm text-gray-900">{{ $member->createdBy->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->created_at->format('d F Y H:i') }}</p>
                        </div>
                        @if($member->updatedBy)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Diperbarui Oleh</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->updatedBy->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Diperbarui</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $member->updated_at->format('d F Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                    <div class="space-y-3">
                        @can('edit members')
                            <a href="{{ route('members.edit', $member->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 17l-2.83-2.828L11 17z"></path>
                                </svg>
                                Edit Data
                            </a>
                        @endcan
                        @can('delete members')
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jemaat ini?')">
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