<!doctype html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Management System</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <div class="drawer lg:drawer-open">
        <!-- Mobile menu toggle -->
        <input id="drawer-toggle" type="checkbox" class="drawer-toggle" />

        <!-- Page content -->
        <div class="drawer-content flex flex-col">
            <!-- Top Navigation -->
            <div class="navbar bg-white shadow-sm border-b border-gray-200">
                <div class="flex-none lg:hidden">
                    <label for="drawer-toggle" class="btn btn-square btn-ghost">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>

                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-800">Church Management System</h1>
                </div>

                <div class="flex-none">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="w-8 rounded-full bg-cyan-500 text-white">
                                <svg class="w-5 h-5 mx-auto mt-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-52 border border-gray-200">
                            <li><a href="{{ route('dashboard') }}" class="text-gray-700 hover:bg-cyan-50">Dashboard</a>
                            </li>
                            <li><a href="#" class="text-gray-700 hover:bg-cyan-50">Profile</a></li>
                            <li><a href="#" class="text-gray-700 hover:bg-cyan-50">Settings</a></li>
                            <li class="divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:bg-red-50 w-full text-left">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side">
            <label for="drawer-toggle" class="drawer-overlay"></label>
            <aside class="w-64 min-h-full bg-gradient-to-b from-cyan-600 to-cyan-700 text-white">
                <!-- Logo -->
                <div class="p-6 border-b border-cyan-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.482 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold">Church CMS</h2>
                            <p class="text-cyan-200 text-sm">Management System</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="p-4">
                    <ul class="space-y-2">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-cyan-100' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                                    </path>
                                </svg>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>

                        <!-- Data Jemaat -->
                        <li>
                            <a href="{{ route('members.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('members.*') ? 'bg-white/20 text-white' : 'text-cyan-100' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                                    </path>
                                </svg>
                                <span class="font-medium">Data Jemaat</span>
                            </a>
                        </li>

                        <!-- Pelayanan -->
                        <li>
                            <a href="{{ route('ministries.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('ministries.*') ? 'bg-white/20 text-white' : 'text-cyan-100' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                    </path>
                                </svg>
                                <span class="font-medium">Pelayanan</span>
                            </a>
                        </li>

                        <!-- Kegiatan -->
                        <li>
                            <a href="{{ route('events.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('events.*') ? 'bg-white/20 text-white' : 'text-cyan-100' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Kegiatan</span>
                            </a>
                        </li>

                        <!-- Keuangan -->
                        <li>
                            <a href="{{ route('finances.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 {{ request()->routeIs('finances.*') ? 'bg-white/20 text-white' : 'text-cyan-100' }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                                    </path>
                                </svg>
                                <span class="font-medium">Keuangan</span>
                            </a>
                        </li>

                        <!-- Divider -->
                        <li class="pt-4">
                            <div class="border-t border-cyan-500"></div>
                        </li>

                        <!-- Laporan -->
                        <li>
                            <a href="#"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 text-cyan-100">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Laporan</span>
                            </a>
                        </li>

                        <!-- Pengaturan -->
                        <li>
                            <a href="#"
                                class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition-colors duration-200 text-cyan-100">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Pengaturan</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- User Info -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-cyan-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Admin User</p>
                            <p class="text-xs text-cyan-200">admin@church.com</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle SweetAlert from session
            @if (session('swal'))
                const swalData = @json(session('swal'));
                Swal.fire({
                    title: swalData.title,
                    text: swalData.text,
                    icon: swalData.icon,
                    confirmButtonColor: swalData.icon === 'success' ? '#10b981' : swalData.icon ===
                        'error' ? '#ef4444' : swalData.icon === 'warning' ? '#f59e0b' : '#3b82f6',
                    timer: swalData.icon === 'success' ? 3000 : null,
                    timerProgressBar: swalData.icon === 'success' ? true : false,
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>

</html>
