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
        body { overflow-x: hidden; }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900 font-inter antialiased">

    {{-- NAVBAR --}}
    <nav x-data="{ open: false, userMenu: false }" class="fixed top-0 left-0 right-0 z-50 h-[72px] bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl md:text-2xl font-black text-forest font-playfair tracking-tight">
                SiTamDeals
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-forest transition">Beranda</a>
                <a href="{{ route('products') }}" class="hover:text-forest transition">Produk</a>
                
                {{-- Cek Login Menggunakan Session User Sesuai Struktur Sistemmu --}}
                @if(session()->has('user'))
                    {{-- Ikon Keranjang Belanja Responsif --}}
                    <a href="{{ route('cart') }}" class="relative text-gray-700 hover:text-forest p-2 transition">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        {{-- Mengambil jumlah total barang unik di keranjang milik user --}}
                        @php
                            $userId = session('user')['id'] ?? session('user')['user_id'] ?? null;
                            $cartCount = \App\Models\Cart::where('user_id', $userId)->sum('qty');
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    {{-- Dropdown Akun Pelanggan (Selamat Datang + Riwayat + Logout) --}}
                    <div class="relative">
                        <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-1.5 hover:text-forest transition outline-none">
                            <span class="text-xs bg-forest/5 text-forest px-3 py-1.5 rounded-full border border-forest/10">
                                👋 Halo, <strong class="font-black">{{ session('user')['name'] }}</strong>
                            </span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
                        </button>
                        
                        {{-- Kotak Pilihan Dropdown --}}
                        <div x-show="userMenu" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl overflow-hidden py-1 z-50">
                            <a href="/orders/history" class="block px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                <i class="fas fa-history text-gray-400"></i> Riwayat Pembelian
                            </a>
                            <hr class="border-gray-100">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-xs text-red-600 hover:bg-red-50 flex items-center gap-2 font-bold">
                                    <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-forest text-white px-5 py-2 rounded-lg hover:bg-sage transition">Login</a>
                @endif
            </div>

            {{-- HAMBURGER BUTTON (MOBILE) --}}
            <div class="flex items-center gap-4 md:hidden">
                @if(session()->has('user'))
                    <a href="{{ route('cart') }}" class="relative text-gray-700 p-2">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute top-0 right-0 bg-red-500 text-white text-[9px] w-3.5 h-3.5 rounded-full flex items-center justify-center font-bold">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endif
                <button @click="open = !open" class="text-forest text-2xl p-2 outline-none">
                    <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div x-show="open" x-transition class="md:hidden absolute w-full bg-white border-b border-gray-200 shadow-xl p-6 flex flex-col gap-2 z-50">
            <a href="{{ route('home') }}" class="block text-gray-600 font-bold py-2 border-b border-gray-50">Beranda</a>
            <a href="{{ route('products') }}" class="block text-gray-600 font-bold py-2 border-b border-gray-50">Produk</a>
            
            @if(session()->has('user'))
                <div class="py-2 text-xs text-gray-400">
                    Masuk sebagai: <span class="text-forest font-bold">{{ session('user')['name'] }}</span>
                </div>
                <a href="/orders/history" class="block text-gray-600 font-bold py-2 border-b border-gray-50 flex items-center gap-2">
                    <i class="fas fa-history"></i> Riwayat Pembelian
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl text-center font-bold text-sm">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full bg-forest text-white px-5 py-3 rounded-lg text-center font-bold mt-2">Login</a>
            @endif
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

    @stack('scripts')
</body>
</html>