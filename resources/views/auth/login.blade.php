@extends('layouts.app')
@section('title', 'SiTamDeals – Masuk')

@push('styles')
<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes floatCard {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-8px); }
    }
    @keyframes shimmer {
        0%   { background-position: -200% center; }
        100% { background-position:  200% center; }
    }
    .animate-fade-up   { animation: fadeUp 0.7s ease both; }
    .animate-fade-up-1 { animation: fadeUp 0.7s ease 0.12s both; }
    .animate-fade-up-2 { animation: fadeUp 0.7s ease 0.24s both; }
    .animate-fade-up-3 { animation: fadeUp 0.7s ease 0.36s both; }
    .animate-fade-up-4 { animation: fadeUp 0.7s ease 0.48s both; }

    /* Input focus ring */
    .input-field {
        background: rgba(255,255,255,0.06);
        border: 1.5px solid rgba(255,255,255,0.12);
        color: #f5f0e8;
        transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
    }
    .input-field::placeholder { color: rgba(255,255,255,0.28); }
    .input-field:focus {
        outline: none;
        border-color: #c9a84c;
        background: rgba(255,255,255,0.10);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.18);
    }

    /* Gold shimmer button */
    .btn-gold {
        background: linear-gradient(90deg, #c9a84c, #e8c96a, #c9a84c);
        background-size: 200% auto;
        transition: background-position 0.6s ease, transform 0.2s, box-shadow 0.2s;
    }
    .btn-gold:hover {
        background-position: right center;
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(201,168,76,0.35);
    }
    .btn-gold:active { transform: translateY(0); }

    /* Password toggle */
    .eye-toggle { color: rgba(255,255,255,0.35); cursor: pointer; }
    .eye-toggle:hover { color: #c9a84c; }

    /* Decorative leaf SVG */
    .deco-leaf { opacity: 0.04; pointer-events: none; }
</style>
@endpush

@section('content')

<section class="min-h-screen flex items-stretch relative overflow-hidden"
    style="background: linear-gradient(145deg, #0e2118 0%, #1a3d2b 50%, #0e2118 100%);">

    {{-- Decorative background blobs --}}
    <div class="absolute top-[-120px] left-[-120px] w-[420px] h-[420px] rounded-full opacity-[0.07]"
         style="background: radial-gradient(circle, #c9a84c, transparent 70%);"></div>
    <div class="absolute bottom-[-80px] right-[-80px] w-[360px] h-[360px] rounded-full opacity-[0.06]"
         style="background: radial-gradient(circle, #4a8c64, transparent 70%);"></div>
    <div class="absolute top-1/2 left-1/4 w-[200px] h-[200px] rounded-full opacity-[0.04]"
         style="background: radial-gradient(circle, #c9a84c, transparent 70%);"></div>

    {{-- Left Panel – Branding --}}
    <div class="hidden lg:flex lg:w-[44%] flex-col justify-between px-14 py-14 relative"
         style="border-right: 1px solid rgba(255,255,255,0.06);">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gold rounded-xl flex items-center justify-center font-playfair font-black text-forest text-lg shadow-lg group-hover:scale-105 transition">
                TJ
            </div>
            <span class="font-playfair text-cream font-bold text-lg tracking-wide">SiTamDeals</span>
        </a>

        {{-- Center Copy --}}
        <div>
            <div class="inline-flex items-center gap-2 bg-gold/10 border border-gold/25 text-gold text-[10px] font-bold tracking-[2px] uppercase px-4 py-1.5 rounded-full mb-8">
                ✦ Swalayan Tambah Jaya
            </div>
            <h2 class="font-playfair text-5xl font-black text-cream leading-[1.1] mb-6">
                Selamat<br>
                <em class="not-italic text-gold">Datang</em><br>
                Kembali
            </h2>
            <p class="text-cream/45 text-sm leading-relaxed max-w-xs">
                Masuk ke akun kamu dan nikmati ribuan produk berkualitas
                dengan harga transparan dari Tambah Jaya.
            </p>

            {{-- Mini stats --}}
            <div class="mt-12 grid grid-cols-3 gap-4">
                @foreach([['1000+','Produk'],['10K+','Pelanggan'],['4.9★','Rating']] as [$v,$l])
                <div class="bg-white/[0.04] border border-white/[0.07] rounded-2xl px-4 py-4 text-center">
                    <div class="font-playfair text-xl font-black text-gold mb-0.5">{{ $v }}</div>
                    <div class="text-[9px] text-cream/35 tracking-widest uppercase">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Footer note --}}
        <p class="text-cream/20 text-[10px] tracking-widest uppercase">Surabaya · Sejak 2021</p>
    </div>

    {{-- Right Panel – Form --}}
    <div class="flex-1 flex items-center justify-center px-6 py-14">
        <div class="w-full max-w-[400px]">

            {{-- Mobile logo --}}
            <div class="lg:hidden text-center mb-10 animate-fade-up">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 bg-gold rounded-xl flex items-center justify-center font-playfair font-black text-forest text-lg shadow-lg">TJ</div>
                    <span class="font-playfair text-cream font-bold text-lg">SiTamDeals</span>
                </a>
            </div>

            <div class="animate-fade-up">
                <h1 class="font-playfair text-3xl font-black text-cream mb-1">Masuk</h1>
                <p class="text-cream/40 text-sm mb-9">Belum punya akun? <a href="{{ route('register') }}" class="text-gold hover:text-yellow-300 font-semibold transition">Daftar sekarang →</a></p>
            </div>

            {{-- Alert error --}}
            @if($errors->any())
            <div class="animate-fade-up mb-6 bg-red-900/30 border border-red-500/30 rounded-2xl px-5 py-4 flex items-start gap-3">
                <span class="text-red-400 mt-0.5">⚠</span>
                <ul class="text-red-300 text-xs space-y-0.5">
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="animate-fade-up-1">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="nama@email.com"
                               class="input-field w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm">
                    </div>
                </div>

                {{-- Password --}}
                <div class="animate-fade-up-2">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50">Password</label>
                        @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[10px] text-gold/70 hover:text-gold transition">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required
                               placeholder="••••••••"
                               class="input-field w-full rounded-2xl pl-11 pr-12 py-3.5 text-sm">
                        <button type="button" onclick="togglePass('password','eye1')"
                                class="eye-toggle absolute right-4 top-1/2 -translate-y-1/2 text-sm transition-colors">
                            <i id="eye1" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div class="animate-fade-up-3 flex items-center gap-3">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 rounded accent-yellow-400">
                    <label for="remember" class="text-xs text-cream/45 cursor-pointer">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <div class="animate-fade-up-4 pt-2">
                    <button type="submit"
                            class="btn-gold w-full text-forest font-black py-4 rounded-2xl text-sm tracking-wide shadow-lg flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                    </button>
                </div>
            </form>

            {{-- Divider --}}
            <div class="animate-fade-up-4 flex items-center gap-4 my-7">
                <div class="flex-1 h-px bg-white/[0.08]"></div>
                <span class="text-[10px] text-cream/25 tracking-widest uppercase">atau</span>
                <div class="flex-1 h-px bg-white/[0.08]"></div>
            </div>

            {{-- Register link --}}
            <div class="animate-fade-up-4 text-center">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 border border-white/10 text-cream/60 text-sm font-semibold px-6 py-3.5 rounded-2xl hover:border-gold/40 hover:text-gold transition-all duration-300 w-full justify-center">
                    <i class="fas fa-user-plus text-xs"></i> Buat Akun Baru
                </a>
            </div>

        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
function togglePass(fieldId, eyeId) {
    const field = document.getElementById(fieldId);
    const eye   = document.getElementById(eyeId);
    if (field.type === 'password') {
        field.type = 'text';
        eye.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        field.type = 'password';
        eye.classList.replace('fa-eye', 'fa-eye-slash');
    }
}
</script>
@endpush