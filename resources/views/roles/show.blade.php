<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Role</h1>
                    <p class="text-gray-600 mt-1">Informasi lengkap role dan permission</p>
                </div>
                <div class="flex space-x-3">
                    {{-- @can('edit roles') --}}
                    <a href="{{ route('roles.edit', $role->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                            </path>
                        </svg>
                        Edit Role
                    </a>
                    {{-- @endcan --}}
                    {{-- @can('assign permissions') --}}
                    <a href="{{ route('roles.assign-permissions', $role->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fa-solid fa-link mr-2"></i>
                        Tugas Permission
                    </a>
                    {{-- @endcan --}}
                    <a href="{{ route('roles.index') }}"
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
        </div>

        <!-- Role Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Role</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Role</label>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                <span class="text-sm font-medium text-purple-600">
                                    {{ strtoupper(substr($role->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-lg font-medium text-gray-900">{{ $role->name }}</div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dibuat</label>
                    <div class="text-sm text-gray-900">{{ $role->created_at->format('d M Y H:i') }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Diperbarui</label>
                    <div class="text-sm text-gray-900">{{ $role->updated_at->format('d M Y H:i') }}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Permission</label>
                    <div class="text-sm text-gray-900">{{ $role->permissions->count() }} permission</div>
                </div>
            </div>
        </div>

        <!-- Permissions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Permission</h3>
                <span class="text-sm text-gray-500">{{ $role->permissions->count() }} permission</span>
            </div>

            @if ($role->permissions->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($role->permissions as $permission)
                        <div class="flex items-center p-3 bg-green-50 border border-green-200 rounded-lg">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm font-medium text-green-800">{{ $permission->name }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada permission</h3>
                    <p class="mt-1 text-sm text-gray-500">Role ini belum memiliki permission.</p>
                </div>
            @endif
        </div>

        <!-- Users with this role -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Pengguna dengan Role Ini</h3>
                <span class="text-sm text-gray-500">{{ $role->users->count() }} pengguna</span>
            </div>

            @if ($role->users->count() > 0)
                <div class="space-y-3">
                    @foreach ($role->users as $user)
                        <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-cyan-100 flex items-center justify-center">
                                        <span class="text-xs font-medium text-cyan-600">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500">
                                Bergabung {{ $user->created_at->format('d M Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pengguna</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada pengguna yang memiliki role ini.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
