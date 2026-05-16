<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'SiTamDeals')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    {{-- Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-cream text-forest overflow-x-hidden" style="font-family:'DM Sans',sans-serif">

{{-- ===================== NAVBAR ===================== --}}
<nav class="fixed top-0 left-0 right-0 z-50 h-[72px] flex items-center justify-between px-[6%] bg-forest/95 backdrop-blur-md border-b border-white/10">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="font-playfair text-xl font-black text-cream tracking-wide">
        SiTam<span class="text-gold">Deals</span>
    </a>

    {{-- Menu Desktop --}}
    <ul class="hidden md:flex items-center gap-8 list-none text-sm font-medium uppercase tracking-widest">
        <li>
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'text-gold border-b-2 border-gold pb-0.5' : 'text-cream/75 hover:text-gold transition' }}">
               Home
            </a>
        </li>
        <li>
            <a href="{{ route('products') }}"
               class="{{ request()->routeIs('products*') ? 'text-gold border-b-2 border-gold pb-0.5' : 'text-cream/75 hover:text-gold transition' }}">
               Produk
            </a>
        </li>

        {{-- Ikon Keranjang --}}
        <li>
            <a href="{{ route('cart') }}" class="relative text-cream/75 hover:text-gold transition">
                <i class="fas fa-shopping-cart text-lg"></i>
                @php
                    $cartCount = session('user')
                        ? \App\Models\Cart::where('user_id', session('user.user_id'))->sum('qty')
                        : 0;
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-gold text-forest text-[9px] font-black w-4 h-4 rounded-full flex items-center justify-center leading-none">
                        {{ $cartCount > 99 ? '99+' : $cartCount }}
                    </span>
                @endif
            </a>
        </li>

        {{-- Dropdown Profil --}}
        <li class="relative">
            <button id="profileBtn" class="text-cream text-xl hover:text-gold transition focus:outline-none">
                <i class="fas fa-user-circle"></i>
            </button>
            <div id="profileDropdown"
                 class="hidden absolute right-0 mt-3 w-52 bg-white rounded-xl shadow-2xl py-2 border border-gray-100">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Masuk sebagai</p>
                    <p class="font-bold text-forest text-sm truncate">{{ session('user.name', 'Pengguna') }}</p>
                </div>
                <a href="{{ route('profil') }}"
                   class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gold/10 hover:text-gold transition text-sm font-medium">
                    <i class="fas fa-user-edit w-4"></i> Profil Saya
                </a>
                <a href="{{ route('history') }}"
                   class="flex items-center gap-2 px-4 py-2.5 text-gray-700 hover:bg-gold/10 hover:text-gold transition text-sm font-medium">
                    <i class="fas fa-history w-4"></i> Riwayat Transaksi
                </a>
            </div>
        </li>
    </ul>

    {{-- Hamburger Mobile --}}
    <button id="mobileMenuBtn" class="md:hidden text-cream text-xl focus:outline-none">
        <i class="fas fa-bars"></i>
    </button>
</nav>

{{-- Mobile Menu --}}
<div id="mobileMenu"
     class="hidden fixed top-[72px] left-0 right-0 z-40 bg-forest flex-col gap-1 p-5 border-b border-white/10 shadow-xl md:hidden">
    <a href="{{ route('home') }}"     class="py-3 text-cream font-bold uppercase tracking-widest text-sm border-b border-white/10">Home</a>
    <a href="{{ route('products') }}" class="py-3 text-cream font-bold uppercase tracking-widest text-sm border-b border-white/10">Produk</a>
    <a href="{{ route('cart') }}"     class="py-3 text-cream font-bold uppercase tracking-widest text-sm border-b border-white/10">Keranjang</a>
    <a href="{{ route('history') }}"  class="py-3 text-cream font-bold uppercase tracking-widest text-sm border-b border-white/10">Riwayat</a>
    <a href="{{ route('profil') }}"   class="py-3 text-cream font-bold uppercase tracking-widest text-sm border-b border-white/10">Profil</a>
</div>

{{-- ===================== KONTEN UTAMA ===================== --}}
<main class="pt-[72px]">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="fixed top-20 left-1/2 -translate-x-1/2 z-50 bg-green-50 border border-green-200 text-green-700 text-sm font-semibold px-6 py-3 rounded-2xl shadow-lg flex items-center gap-2 animate-fade-down">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-20 left-1/2 -translate-x-1/2 z-50 bg-red-50 border border-red-200 text-red-700 text-sm font-semibold px-6 py-3 rounded-2xl shadow-lg flex items-center gap-2 animate-fade-down">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

{{-- ===================== FOOTER ===================== --}}
<footer class="bg-forest text-white/30 text-center py-10 text-xs tracking-wide">
    &copy; {{ date('Y') }} <span class="text-gold font-bold">SiTamDeals</span>
    — Proyek Website UPN "Veteran" Jawa Timur
</footer>

{{-- ===================== SCRIPTS ===================== --}}
<script>
    // Dropdown profil
    const profileBtn      = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    if (profileBtn) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });
        window.addEventListener('click', () => profileDropdown.classList.add('hidden'));
    }

    // Mobile menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu    = document.getElementById('mobileMenu');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });
    }

    // Auto-hide flash message setelah 3 detik
    setTimeout(() => {
        document.querySelectorAll('[class*="animate-fade-down"]').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity    = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 3000);
</script>

@stack('scripts')
</body>
</html>