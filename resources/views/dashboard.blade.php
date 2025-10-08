<x-layouts.app>
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
                <p class="text-gray-600 text-lg">Selamat datang di Church Management System</p>
                <div class="mt-4">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Sistem Terintegrasi
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Members -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Jemaat</h3>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMembers) }}</p>
                        <p class="text-sm text-gray-500">Anggota terdaftar</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Members -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Jemaat Aktif</h3>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($activeMembers) }}</p>
                        <p class="text-sm text-gray-500">Anggota aktif</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Ministries -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Pelayanan</h3>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMinistries) }}</p>
                        <p class="text-sm text-gray-500">Departemen aktif</p>
                    </div>
                    <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Kegiatan Mendatang</h3>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($upcomingEvents) }}</p>
                        <p class="text-sm text-gray-500">Event terjadwal</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Offering -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Persembahan Bulan Ini</h3>
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($monthlyOffering, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500 mb-4">Total persembahan bulan ini</p>
                <a href="{{ route('finances.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Detail
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Monthly Expense -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pengeluaran Bulan Ini</h3>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($monthlyExpense, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500 mb-4">Total pengeluaran bulan ini</p>
                <a href="{{ route('finances.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Lihat Detail
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Aksi Cepat</h2>
                <p class="text-gray-600">Kelola data gereja dengan mudah</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('members.create') }}"
                    class="group bg-blue-50 hover:bg-blue-100 rounded-lg p-6 text-center transition-colors duration-200">
                    <div
                        class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Tambah Jemaat</h3>
                    <p class="text-sm text-gray-600">Daftarkan anggota baru</p>
                </a>

                <a href="{{ route('ministries.create') }}"
                    class="group bg-cyan-50 hover:bg-cyan-100 rounded-lg p-6 text-center transition-colors duration-200">
                    <div
                        class="w-12 h-12 bg-cyan-500 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-cyan-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Tambah Pelayanan</h3>
                    <p class="text-sm text-gray-600">Buat departemen baru</p>
                </a>

                <a href="{{ route('events.create') }}"
                    class="group bg-orange-50 hover:bg-orange-100 rounded-lg p-6 text-center transition-colors duration-200">
                    <div
                        class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-orange-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Tambah Kegiatan</h3>
                    <p class="text-sm text-gray-600">Jadwalkan event</p>
                </a>

                <a href="{{ route('finances.create-offering') }}"
                    class="group bg-emerald-50 hover:bg-emerald-100 rounded-lg p-6 text-center transition-colors duration-200">
                    <div
                        class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-600 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Catat Keuangan</h3>
                    <p class="text-sm text-gray-600">Input persembahan</p>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Members -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Jemaat Terbaru</h3>
                </div>
                <div class="p-6">
                    @if ($recentMembers->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentMembers as $member)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $member->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $member->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst($member->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada jemaat terdaftar</p>
                    @endif
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Kegiatan Mendatang</h3>
                </div>
                <div class="p-6">
                    @if ($upcomingEventsList->count() > 0)
                        <div class="space-y-4">
                            @foreach ($upcomingEventsList as $event)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $event->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $event->start_date->format('d M Y') }}</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada kegiatan terjadwal</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
