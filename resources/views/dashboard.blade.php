<x-layouts.app>
    <div class="min-h-screen bg-base-200">
        <!-- Header -->
        <div class="bg-primary text-primary-content">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <p class="text-primary-content/80">Selamat datang di Church Management System</p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Members -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="card-title text-primary">Total Jemaat</h2>
                                <p class="text-3xl font-bold">{{ number_format($totalMembers) }}</p>
                            </div>
                            <div class="text-primary">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Members -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="card-title text-success">Jemaat Aktif</h2>
                                <p class="text-3xl font-bold">{{ number_format($activeMembers) }}</p>
                            </div>
                            <div class="text-success">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Ministries -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="card-title text-info">Total Pelayanan</h2>
                                <p class="text-3xl font-bold">{{ number_format($totalMinistries) }}</p>
                            </div>
                            <div class="text-info">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="card-title text-warning">Kegiatan Mendatang</h2>
                                <p class="text-3xl font-bold">{{ number_format($upcomingEvents) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Monthly Offering -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-success">Persembahan Bulan Ini</h2>
                        <p class="text-3xl font-bold">Rp {{ number_format($monthlyOffering, 0, ',', '.') }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('finances.index') }}" class="btn btn-success btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <!-- Monthly Expense -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-error">Pengeluaran Bulan Ini</h2>
                        <p class="text-3xl font-bold">Rp {{ number_format($monthlyExpense, 0, ',', '.') }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('finances.index') }}" class="btn btn-error btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Members -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Jemaat Terbaru</h2>
                        <div class="space-y-4">
                            @forelse($recentMembers as $member)
                                <div class="flex items-center space-x-3">
                                    <div class="avatar">
                                        <div class="w-10 h-10 rounded-full">
                                            @if($member->photo)
                                                <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}">
                                            @else
                                                <div class="bg-primary text-primary-content flex items-center justify-center">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">{{ $member->name }}</h3>
                                        <p class="text-sm text-base-content/60">{{ $member->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-base-content/60">Belum ada jemaat terbaru</p>
                            @endforelse
                        </div>
                        <div class="card-actions justify-end">
                            <a href="{{ route('members.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Kegiatan Mendatang</h2>
                        <div class="space-y-4">
                            @forelse($upcomingEventsList as $event)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-primary text-primary-content rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">{{ $event->title }}</h3>
                                        <p class="text-sm text-base-content/60">{{ $event->start_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-base-content/60">Tidak ada kegiatan mendatang</p>
                            @endforelse
                        </div>
                        <div class="card-actions justify-end">
                            <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('members.create') }}" class="btn btn-primary btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                        </svg>
                        Tambah Jemaat
                    </a>
                    <a href="{{ route('ministries.create') }}" class="btn btn-info btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                        Tambah Pelayanan
                    </a>
                    <a href="{{ route('events.create') }}" class="btn btn-warning btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        Tambah Kegiatan
                    </a>
                    <a href="{{ route('finances.create') }}" class="btn btn-success btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                        </svg>
                        Catat Keuangan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
