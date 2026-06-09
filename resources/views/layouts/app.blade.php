<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiTamDeals')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#12261C',
                        gold: '#D4AF37',
                        cream: '#FFF8DC',
                        sage: '#4A7C59',
                    },
                    fontFamily: {
                        playfair: ['Playfair Display', 'serif'],
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Mencegah konten meluber ke samping */
        body { overflow-x: hidden; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-inter antialiased">

    {{-- NAVBAR --}}
    <nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 h-[72px] bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl md:text-2xl font-black text-forest font-playfair tracking-tight">
                SiTamDeals
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-forest transition">Beranda</a>
                <a href="{{ route('products') }}" class="hover:text-forest transition">Produk</a>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-forest text-white px-5 py-2 rounded-lg hover:bg-sage transition">Login</a>
                @endauth
            </div>

            {{-- HAMBURGER BUTTON --}}
            <button @click="open = !open" class="md:hidden text-forest text-2xl p-2">
                <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>

        {{-- MOBILE MENU --}}
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden absolute w-full bg-white border-b border-gray-200 shadow-xl p-6 flex flex-col gap-4">
            <a href="{{ route('home') }}" class="block text-gray-600 font-bold py-2">Beranda</a>
            <a href="{{ route('products') }}" class="block text-gray-600 font-bold py-2">Produk</a>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left text-red-600 font-bold py-2">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full bg-forest text-white px-5 py-3 rounded-lg text-center font-bold">Login</a>
            @endauth
        </div>
    </nav>

    {{-- MAIN --}}
    <main class="pt-[72px] min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-forest text-white py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h3 class="font-playfair text-xl text-gold font-bold mb-4">SiTamDeals</h3>
                <p class="text-white/60 text-sm leading-relaxed">Belanja hemat, jujur, dan mudah. Solusi kebutuhan harian warga Surabaya.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Navigasi</h4>
                <ul class="text-white/60 text-sm space-y-3">
                    <li><a href="#" class="hover:text-gold transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-gold transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>