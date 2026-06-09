<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SiTamDeals')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#0A1A12] text-white">

    {{-- Navbar Putih Bersih --}}
    <nav class="fixed top-0 left-0 right-0 z-50 h-[72px] flex items-center px-[6%] bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('home') }}" class="text-xl font-black text-black tracking-wide font-['Playfair_Display']">
            SiTamDeals
        </a>
    </nav>

    <main class="pt-[72px] min-h-screen">
        @yield('content')
    </main>

</body>
</html>