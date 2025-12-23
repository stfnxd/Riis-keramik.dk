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
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <!-- Left side: brand name -->
        <a href="{{ route('shop.index') }}" class="text-2xl font-bold text-gray-900">L-Riis</a>

        <!-- Right side: navigation buttons -->
        <nav class="space-x-4">
            <a href="/" class="text-gray-800 hover:text-orange-200 transform transition-transform duration-200 hover:translate-x-2 hover:scale-105">Gallery</a>
            <a href="/shop" class="text-gray-800 hover:text-orange-200 transform transition-transform duration-200 hover:translate-x-2 hover:scale-105">Shop</a>
        </nav>
    </header>

    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

    <footer class="text-center text-gray-500 text-sm py-4">
        © {{ date('Y') }} Riis Keramik
    </footer>
</body>
</html>
