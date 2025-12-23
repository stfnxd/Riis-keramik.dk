<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Riis Keramik') }}</title>
    <!-- Google Fonts link -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
<header class="bg-white shadow p-4 flex justify-between items-center relative z-50">
    <!-- Brand -->
    <a href="{{ route('shop.index') }}" class="text-2xl font-bold text-gray-900">Riis Keramik.</a>

    <!-- Hamburger button + menu -->
    <div x-data="{ open: false }" class="relative z-50">
        <!-- Hamburger button (mobile) -->
        <button @click="open = !open" class="sm:hidden focus:outline-none z-50 relative">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Navigation menu -->
        <nav 
            :class="{'block': open, 'hidden': !open}" 
            class="absolute right-0 top-full mt-2 bg-white border rounded shadow-sm sm:static sm:flex sm:space-x-4 sm:mt-0 sm:bg-transparent sm:border-none sm:shadow-none hidden w-40 z-50"
        >
            <a href="/" class="block px-4 py-2 text-gray-800 hover:text-orange-200 sm:px-0 sm:py-0 transform transition-transform duration-200 hover:translate-x-2 hover:scale-105">Gallery</a>
            <a href="/shop" class="block px-4 py-2 text-gray-800 hover:text-orange-200 sm:px-0 sm:py-0 transform transition-transform duration-200 hover:translate-x-2 hover:scale-105">Shop</a>
        </nav>
    </div>
</header>
    <!-- Main Content -->
    <main class="container mx-auto py-8 sm:py-10 px-4 sm:px-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm py-4">
        © {{ date('Y') }} Riis Keramik
    </footer>

</body>
</html>
