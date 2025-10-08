<x-layouts.app>
    <div class="min-h-screen bg-base-200">
        <!-- Header -->
        <div class="bg-primary text-primary-content">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">{{ $member->name }}</h1>
                        <p class="text-primary-content/80">Detail informasi jemaat</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('members.index') }}" class="btn btn-outline btn-primary-content">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Kembali
                        </a>
                        @can('edit members')
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body text-center">
                            <div class="avatar mb-4">
                                <div class="w-32 h-32 rounded-full mx-auto">
                                    @if ($member->photo)
                                        <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}"
                                            class="rounded-full">
                                    @else
                                        <div
                                            class="bg-primary text-primary-content flex items-center justify-center text-4xl font-bold rounded-full">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h2 class="card-title justify-center text-2xl">{{ $member->name }}</h2>
                            <div
                                class="badge {{ $member->status == 'aktif' ? 'badge-success' : ($member->status == 'tidak aktif' ? 'badge-warning' : 'badge-error') }} badge-lg">
                                {{ ucfirst($member->status) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Cards -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Personal Information -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Informasi Pribadi</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Jenis Kelamin</span>
                                    </label>
                                    <p>{{ ucfirst($member->gender) }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tanggal Lahir</span>
                                    </label>
                                    <p>{{ $member->birth_date ? $member->birth_date->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tempat Lahir</span>
                                    </label>
                                    <p>{{ $member->birth_place ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Umur</span>
                                    </label>
                                    <p>{{ $member->age ? $member->age . ' tahun' : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Status Pernikahan</span>
                                    </label>
                                    <p>{{ ucfirst($member->marital_status) }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Pekerjaan</span>
                                    </label>
                                    <p>{{ $member->occupation ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Pendidikan</span>
                                    </label>
                                    <p>{{ $member->education ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Email</span>
                                    </label>
                                    <p>{{ $member->email ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">No. Telepon</span>
                                    </label>
                                    <p>{{ $member->phone ?: '-' }}</p>
                                </div>
                            </div>
                            @if ($member->address)
                                <div class="mt-4">
                                    <label class="label">
                                        <span class="label-text font-semibold">Alamat</span>
                                    </label>
                                    <p>{{ $member->address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Religious Information -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Informasi Keagamaan</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tanggal Baptis</span>
                                    </label>
                                    <p>{{ $member->baptism_date ? $member->baptism_date->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tempat Baptis</span>
                                    </label>
                                    <p>{{ $member->baptism_place ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tanggal Sidi</span>
                                    </label>
                                    <p>{{ $member->sidi_date ? $member->sidi_date->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tempat Sidi</span>
                                    </label>
                                    <p>{{ $member->sidi_place ?: '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tanggal Pernikahan</span>
                                    </label>
                                    <p>{{ $member->marriage_date ? $member->marriage_date->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Tempat Pernikahan</span>
                                    </label>
                                    <p>{{ $member->marriage_place ?: '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Family Information -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4">Informasi Keluarga</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Keluarga</span>
                                    </label>
                                    <p>{{ $member->family ? $member->family->family_name : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Ayah</span>
                                    </label>
                                    <p>{{ $member->father ? $member->father->name : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Ibu</span>
                                    </label>
                                    <p>{{ $member->mother ? $member->mother->name : '-' }}</p>
                                </div>
                                <div>
                                    <label class="label">
                                        <span class="label-text font-semibold">Pasangan</span>
                                    </label>
                                    <p>{{ $member->spouse ? $member->spouse->name : '-' }}</p>
                                </div>
                            </div>

                            @if ($member->children->count() > 0)
                                <div class="mt-4">
                                    <label class="label">
                                        <span class="label-text font-semibold">Anak-anak</span>
                                    </label>
                                    <div class="space-y-2">
                                        @foreach ($member->children as $child)
                                            <div class="flex items-center space-x-2">
                                                <span class="badge badge-outline">{{ $child->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Ministries -->
                    @if ($member->ministries->count() > 0)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title text-2xl mb-4">Pelayanan</h2>
                                <div class="space-y-2">
                                    @foreach ($member->ministries as $memberMinistry)
                                        <div class="flex items-center justify-between p-3 bg-base-200 rounded-lg">
                                            <div>
                                                <h3 class="font-semibold">{{ $memberMinistry->ministry->name }}</h3>
                                                @if ($memberMinistry->position)
                                                    <p class="text-sm opacity-70">{{ $memberMinistry->position }}</p>
                                                @endif
                                            </div>
                                            <div
                                                class="badge {{ $memberMinistry->status == 'aktif' ? 'badge-success' : 'badge-warning' }}">
                                                {{ ucfirst($memberMinistry->status) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Notes -->
                    @if ($member->notes)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title text-2xl mb-4">Catatan</h2>
                                <p>{{ $member->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
