@extends('layouts.app')
@section('title', 'SiTamDeals – Daftar Akun')

@push('styles')
<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up   { animation: fadeUp 0.7s ease both; }
    .animate-fade-up-1 { animation: fadeUp 0.7s ease 0.10s both; }
    .animate-fade-up-2 { animation: fadeUp 0.7s ease 0.20s both; }
    .animate-fade-up-3 { animation: fadeUp 0.7s ease 0.30s both; }
    .animate-fade-up-4 { animation: fadeUp 0.7s ease 0.40s both; }
    .animate-fade-up-5 { animation: fadeUp 0.7s ease 0.50s both; }
    .animate-fade-up-6 { animation: fadeUp 0.7s ease 0.60s both; }

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
    .input-field.is-error {
        border-color: rgba(239,68,68,0.6);
        box-shadow: 0 0 0 3px rgba(239,68,68,0.12);
    }

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

    .eye-toggle { color: rgba(255,255,255,0.35); cursor: pointer; }
    .eye-toggle:hover { color: #c9a84c; }

    /* Password strength bar */
    #strength-bar {
        height: 3px;
        border-radius: 99px;
        background: rgba(255,255,255,0.08);
        overflow: hidden;
        transition: all 0.3s;
    }
    #strength-fill {
        height: 100%;
        width: 0%;
        border-radius: 99px;
        transition: width 0.4s ease, background 0.4s ease;
    }

    /* Benefit pill */
    .benefit-pill {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 99px;
        padding: 6px 14px;
        font-size: 11px;
        color: rgba(245,240,232,0.50);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')

<section class="min-h-screen flex items-stretch relative overflow-hidden"
    style="background: linear-gradient(145deg, #0e2118 0%, #1a3d2b 55%, #0e2118 100%);">

    {{-- Decorative blobs --}}
    <div class="absolute top-[-100px] right-[-100px] w-[380px] h-[380px] rounded-full opacity-[0.07]"
         style="background: radial-gradient(circle, #c9a84c, transparent 70%);"></div>
    <div class="absolute bottom-[-60px] left-[-60px] w-[300px] h-[300px] rounded-full opacity-[0.05]"
         style="background: radial-gradient(circle, #4a8c64, transparent 70%);"></div>

    {{-- Left Panel – Branding --}}
    <div class="hidden lg:flex lg:w-[42%] flex-col justify-between px-14 py-14 relative"
         style="border-right: 1px solid rgba(255,255,255,0.06);">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gold rounded-xl flex items-center justify-center font-playfair font-black text-forest text-lg shadow-lg group-hover:scale-105 transition">
                TJ
            </div>
            <span class="font-playfair text-cream font-bold text-lg tracking-wide">SiTamDeals</span>
        </a>

        {{-- Copy --}}
        <div>
            <div class="inline-flex items-center gap-2 bg-gold/10 border border-gold/25 text-gold text-[10px] font-bold tracking-[2px] uppercase px-4 py-1.5 rounded-full mb-8">
                ✦ Gratis & Mudah
            </div>
            <h2 class="font-playfair text-5xl font-black text-cream leading-[1.1] mb-6">
                Gabung &<br>
                Mulai <em class="not-italic text-gold">Hemat</em><br>
                Hari Ini
            </h2>
            <p class="text-cream/45 text-sm leading-relaxed max-w-xs mb-10">
                Daftar gratis dan nikmati akses ke ribuan produk berkualitas
                dengan sistem grade yang jujur.
            </p>

            {{-- Benefits --}}
            <div class="space-y-3">
                @foreach([
                    ['✅', 'Harga transparan sesuai kondisi barang'],
                    ['🏷️', 'Sistem Grade A, B, C – hemat hingga 50%'],
                    ['📦', 'Keranjang belanja & riwayat transaksi'],
                    ['📋', 'Pantau pesanan kapan saja'],
                ] as [$icon, $text])
                <div class="flex items-center gap-3">
                    <span class="text-base">{{ $icon }}</span>
                    <span class="text-xs text-cream/50">{{ $text }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <p class="text-cream/20 text-[10px] tracking-widest uppercase">Surabaya · Sejak 2021</p>
    </div>

    {{-- Right Panel – Form --}}
    <div class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-[420px]">

            {{-- Mobile logo --}}
            <div class="lg:hidden text-center mb-8 animate-fade-up">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 bg-gold rounded-xl flex items-center justify-center font-playfair font-black text-forest text-lg shadow-lg">TJ</div>
                    <span class="font-playfair text-cream font-bold text-lg">SiTamDeals</span>
                </a>
            </div>

            <div class="animate-fade-up">
                <h1 class="font-playfair text-3xl font-black text-cream mb-1">Buat Akun</h1>
                <p class="text-cream/40 text-sm mb-8">Sudah punya akun? <a href="{{ route('login') }}" class="text-gold hover:text-yellow-300 font-semibold transition">Masuk di sini →</a></p>
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

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="animate-fade-up-1">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="John Doe"
                               class="input-field w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm {{ $errors->has('name') ? 'is-error' : '' }}">
                    </div>
                    @error('name')
                    <p class="text-red-400 text-[10px] mt-1.5 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="animate-fade-up-2">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="nama@email.com"
                               class="input-field w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm {{ $errors->has('email') ? 'is-error' : '' }}">
                    </div>
                    @error('email')
                    <p class="text-red-400 text-[10px] mt-1.5 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. HP --}}
                <div class="animate-fade-up-3">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">No. HP <span class="text-cream/25 normal-case tracking-normal font-normal">(opsional)</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               placeholder="08xxxxxxxxxx"
                               class="input-field w-full rounded-2xl pl-11 pr-4 py-3.5 text-sm {{ $errors->has('phone') ? 'is-error' : '' }}">
                    </div>
                    @error('phone')
                    <p class="text-red-400 text-[10px] mt-1.5 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="animate-fade-up-4">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required
                               placeholder="Min. 8 karakter"
                               oninput="checkStrength(this.value)"
                               class="input-field w-full rounded-2xl pl-11 pr-12 py-3.5 text-sm {{ $errors->has('password') ? 'is-error' : '' }}">
                        <button type="button" onclick="togglePass('password','eye1')"
                                class="eye-toggle absolute right-4 top-1/2 -translate-y-1/2 text-sm transition-colors">
                            <i id="eye1" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                    {{-- Strength bar --}}
                    <div id="strength-bar" class="mt-2">
                        <div id="strength-fill"></div>
                    </div>
                    <p id="strength-text" class="text-[10px] text-cream/30 mt-1"></p>
                    @error('password')
                    <p class="text-red-400 text-[10px] mt-1 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="animate-fade-up-5">
                    <label class="block text-[10px] font-bold tracking-[2px] uppercase text-cream/50 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cream/30 text-sm">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               placeholder="Ulangi password"
                               class="input-field w-full rounded-2xl pl-11 pr-12 py-3.5 text-sm">
                        <button type="button" onclick="togglePass('password_confirmation','eye2')"
                                class="eye-toggle absolute right-4 top-1/2 -translate-y-1/2 text-sm transition-colors">
                            <i id="eye2" class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="animate-fade-up-6 flex items-start gap-3 pt-1">
                    <input type="checkbox" name="terms" id="terms" required
                           class="w-4 h-4 mt-0.5 rounded accent-yellow-400 flex-shrink-0">
                    <label for="terms" class="text-xs text-cream/40 leading-relaxed cursor-pointer">
                        Saya menyetujui <a href="#" class="text-gold hover:underline">Syarat & Ketentuan</a>
                        serta <a href="#" class="text-gold hover:underline">Kebijakan Privasi</a> SiTamDeals.
                    </label>
                </div>

                {{-- Submit --}}
                <div class="animate-fade-up-6 pt-2">
                    <button type="submit"
                            class="btn-gold w-full text-forest font-black py-4 rounded-2xl text-sm tracking-wide shadow-lg flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </button>
                </div>
            </form>

            {{-- Divider --}}
            <div class="animate-fade-up-6 flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-white/[0.08]"></div>
                <span class="text-[10px] text-cream/25 tracking-widest uppercase">atau</span>
                <div class="flex-1 h-px bg-white/[0.08]"></div>
            </div>

            <div class="animate-fade-up-6 text-center">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 border border-white/10 text-cream/60 text-sm font-semibold px-6 py-3.5 rounded-2xl hover:border-gold/40 hover:text-gold transition-all duration-300 w-full justify-center">
                    <i class="fas fa-sign-in-alt text-xs"></i> Sudah Punya Akun? Masuk
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

function checkStrength(val) {
    const fill = document.getElementById('strength-fill');
    const text = document.getElementById('strength-text');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { w: '0%',   c: 'transparent', t: '' },
        { w: '25%',  c: '#ef4444', t: 'Lemah' },
        { w: '50%',  c: '#f59e0b', t: 'Sedang' },
        { w: '75%',  c: '#84cc16', t: 'Kuat' },
        { w: '100%', c: '#22c55e', t: 'Sangat Kuat' },
    ];
    const lv = levels[score] || levels[0];
    fill.style.width      = lv.w;
    fill.style.background = lv.c;
    text.textContent      = lv.t;
    text.style.color      = lv.c;
}
</script>
@endpush