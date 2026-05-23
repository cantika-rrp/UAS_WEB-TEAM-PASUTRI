<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDC LAB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white p-4 shadow-sm flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-tr from-yellow-400 via-pink-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xs">EDC</div>
            <span class="font-bold text-xl tracking-wider">EDC LAB</span>
        </div>

        <div class="hidden md:flex flex-1 max-w-md mx-4">
            <div class="relative w-full">
                <i class="fa-solid fa-search absolute left-3 top-3 text-gray-400"></i>
                <input type="text" class="w-full border border-gray-300 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:border-pink-500" placeholder="Cari desain...">
            </div>
        </div>

        <div class="flex items-center space-x-6 text-xl text-gray-700">
            <a href="#" class="hover:text-pink-600"><i class="fa-solid fa-bag-shopping"></i></a>
            <a href="#" class="hover:text-pink-600"><i class="fa-solid fa-star"></i></a>
            <a href="#" class="hover:text-pink-600"><i class="fa-solid fa-circle-user"></i></a>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

</body>
</html>