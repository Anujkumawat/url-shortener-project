<!-- Left Sidebar Navigation -->
<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
    <!-- Sidebar Backdrop (Mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-gray-600 opacity-50 md:hidden z-20">
    </div>

    <!-- Sidebar -->
    <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
        class="fixed md:relative md:translate-x-0 left-0 top-0 z-30 w-64 h-screen bg-white shadow-lg transition-transform duration-300 ease-in-out flex flex-col">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-20 px-6 bg-indigo-600 text-white flex-shrink-0">
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-8 w-auto fill-current text-white" />
                </a>
                <span class="text-lg font-semibold hidden sm:inline">{{ config('app.name', 'Laravel') }}</span>
            </div>
            <!-- Close Button (Mobile) -->
            <button @click="sidebarOpen = false" class="md:hidden text-white hover:bg-indigo-700 p-1 rounded">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 px-2 py-2 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    <span class="font-medium">{{ __('Dashboard') }}</span>
                </a>
                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-3 px-2 py-2 transition-colors duration-200 {{ request()->routeIs('profile.edit') ? 'text-indigo-600' : 'text-gray-700 hover:text-indigo-600' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-sm font-medium">{{ __('Profile') }}</span>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 px-2 py-2 text-red-600 hover:text-red-700 transition-colors duration-200 w-full">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-sm font-medium">{{ __('Log Out') }}</span>
                    </button>
                </form>
            </nav>



            <!-- User Profile Section -->
            <div class="border-t border-gray-200 px-4 py-4 space-y-2 flex-shrink-0">


                <!-- Divider -->
                {{-- <div class="border-t border-gray-200 my-2"></div> --}}

                <!-- User Info -->
                <div class="flex items-center space-x-3 mt-4">
                    <div
                        class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white flex-shrink-0">
                        <span class="text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Toggle Button (Top Left) -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="md:hidden fixed top-4 left-4 z-40 bg-indigo-600 text-white p-2 rounded-lg shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        <svg x-show="!sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>