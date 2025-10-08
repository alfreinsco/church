<x-layouts.app>
    <div class="min-h-screen bg-base-200">
        <!-- Header -->
        <div class="bg-primary text-primary-content">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Data Jemaat</h1>
                        <p class="text-primary-content/80">Kelola data jemaat gereja</p>
                    </div>
                    @can('create members')
                        <a href="{{ route('members.create') }}" class="btn btn-success">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
                                </path>
                            </svg>
                            Tambah Jemaat
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Filters -->
            <div class="card bg-base-100 shadow-xl mb-6">
                <div class="card-body">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Cari Nama</span>
                            </label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="input input-bordered" placeholder="Masukkan nama jemaat">
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Status</span>
                            </label>
                            <select name="status" class="select select-bordered">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="tidak aktif" {{ request('status') == 'tidak aktif' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                                <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah
                                </option>
                                <option value="meninggal" {{ request('status') == 'meninggal' ? 'selected' : '' }}>
                                    Meninggal</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Jenis Kelamin</span>
                            </label>
                            <select name="gender" class="select select-bordered">
                                <option value="">Semua</option>
                                <option value="laki-laki" {{ request('gender') == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="perempuan" {{ request('gender') == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Status Pernikahan</span>
                            </label>
                            <select name="marital_status" class="select select-bordered">
                                <option value="">Semua</option>
                                <option value="belum menikah"
                                    {{ request('marital_status') == 'belum menikah' ? 'selected' : '' }}>Belum Menikah
                                </option>
                                <option value="menikah" {{ request('marital_status') == 'menikah' ? 'selected' : '' }}>
                                    Menikah</option>
                                <option value="cerai" {{ request('marital_status') == 'cerai' ? 'selected' : '' }}>
                                    Cerai</option>
                                <option value="janda" {{ request('marital_status') == 'janda' ? 'selected' : '' }}>
                                    Janda</option>
                                <option value="duda" {{ request('marital_status') == 'duda' ? 'selected' : '' }}>Duda
                                </option>
                            </select>
                        </div>

                        <div class="form-control md:col-span-4">
                            <div class="flex gap-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('members.index') }}" class="btn btn-outline">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Members Table -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Kontak</th>
                                    <th>Status</th>
                                    <th>Keluarga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <div class="w-12 h-12 rounded-full">
                                                    @if ($member->photo)
                                                        <img src="{{ asset($member->photo) }}"
                                                            alt="{{ $member->name }}">
                                                    @else
                                                        <div
                                                            class="bg-primary text-primary-content flex items-center justify-center">
                                                            {{ substr($member->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="font-bold">{{ $member->name }}</div>
                                                <div class="text-sm opacity-50">{{ ucfirst($member->gender) }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                @if ($member->phone)
                                                    <div class="text-sm">{{ $member->phone }}</div>
                                                @endif
                                                @if ($member->email)
                                                    <div class="text-sm opacity-50">{{ $member->email }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="badge {{ $member->status == 'aktif' ? 'badge-success' : ($member->status == 'tidak aktif' ? 'badge-warning' : 'badge-error') }}">
                                                {{ ucfirst($member->status) }}
                                            </div>
                                        </td>
                                        <td>
                                            @if ($member->family)
                                                <div class="text-sm">{{ $member->family->family_name }}</div>
                                            @else
                                                <span class="text-sm opacity-50">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                @can('view members')
                                                    <a href="{{ route('members.show', $member->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                            <path fill-rule="evenodd"
                                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </a>
                                                @endcan
                                                @can('edit members')
                                                    <a href="{{ route('members.edit', $member->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                @endcan
                                                @can('delete members')
                                                    <form action="{{ route('members.destroy', $member->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jemaat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-error btn-sm">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM8 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8">
                                            <div class="text-base-content/60">
                                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                                    </path>
                                                </svg>
                                                <p>Tidak ada data jemaat</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($members->hasPages())
                        <div class="mt-6">
                            {{ $members->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
