@extends('layouts.app')
@section('title', 'SiTamDeals – Masuk')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap');

    .font-playfair { font-family: 'Playfair Display', serif; }
    .font-sans { font-family: 'Inter', sans-serif; }

    .glass-panel {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(16px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }

    .btn-gold {
        background: linear-gradient(90deg, #c9a84c, #e8c96a, #c9a84c);
        background-size: 200% auto;
        color: #0e2118;
        transition: all 0.4s ease;
    }
    .btn-gold:hover {
        background-position: right center;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(201, 168, 76, 0.3);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.6s ease forwards; }
</style>
@endpush

@section('content')
<section class="flex flex-col lg:flex-row items-stretch w-full relative overflow-hidden bg-[#0A1A12] pt-24 pb-12 px-6 min-h-[calc(100vh-80px)]">

<!-- Background Decoration -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#1a4a2e] rounded-full filter blur-[120px] opacity-60 pointer-events-none"></div>
    <div class="absolute top-[20%] right-[0%] w-[40%] h-[50%] bg-[#c9a84c] rounded-full filter blur-[150px] opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[20%] w-[40%] h-[40%] bg-[#0e2118] rounded-full filter blur-[100px] opacity-90 pointer-events-none"></div>

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#1a4a2e] rounded-full filter blur-[120px] opacity-60 pointer-events-none"></div>
    <div class="hidden lg:flex lg:w-1/2 flex-col justify-center px-12 xl:px-20 relative z-10 animate-fade-up">
        
        <div class="mb-8">
            <span class="inline-flex items-center px-5 py-2 rounded-full bg-white/[0.03] border border-[#c9a84c]/60 text-[#c9a84c] text-[11px] font-bold tracking-[2px] uppercase backdrop-blur-md shadow-[0_0_15px_rgba(201,168,76,0.25)] font-sans">
                ✦ Swalayan Tambah Jaya
            </span>
        </div>

        <h1 class="text-6xl xl:text-[76px] font-playfair font-black text-white leading-[1.1] mb-6 tracking-tight">
            Selamat<br>
            <span class="italic text-[#c9a84c] drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]">Datang</span><br>
            Kembali
        </h1>

        <p class="text-white/80 text-[15px] max-w-md leading-relaxed mb-12 font-sans font-medium">
            Masuk ke akun kamu dan nikmati ribuan produk berkualitas dengan harga transparan dari Tambah Jaya.
        </p>

        <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-4 bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 backdrop-blur-lg hover:border-[#c9a84c]/40 transition-all shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <div class="text-[#c9a84c] text-[28px] drop-shadow-[0_0_10px_rgba(201,168,76,0.6)]"><i class="fas fa-box-open"></i></div>
                <div>
                    <div class="font-sans font-bold text-white text-xl leading-tight">1000+</div>
                    <div class="text-[10px] text-white/50 uppercase tracking-[2px] font-sans font-bold mt-1">Produk</div>
                </div>
            </div>
            
            <div class="flex items-center gap-4 bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 backdrop-blur-lg hover:border-[#c9a84c]/40 transition-all shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <div class="text-[#c9a84c] text-[28px] drop-shadow-[0_0_10px_rgba(201,168,76,0.6)]"><i class="fas fa-users"></i></div>
                <div>
                    <div class="font-sans font-bold text-white text-xl leading-tight">10K+</div>
                    <div class="text-[10px] text-white/50 uppercase tracking-[2px] font-sans font-bold mt-1">Pelanggan</div>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 backdrop-blur-lg hover:border-[#c9a84c]/40 transition-all shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <div class="text-[#c9a84c] text-[28px] drop-shadow-[0_0_10px_rgba(201,168,76,0.6)]"><i class="fas fa-star"></i></div>
                <div>
                    <div class="font-sans font-bold text-white text-xl leading-tight">4.9★</div>
                    <div class="text-[10px] text-white/50 uppercase tracking-[2px] font-sans font-bold mt-1">Rating</div>
                </div>
            </div>
        </div>
    </div>

  <div class="w-full lg:w-1/2 flex items-center justify-center relative z-10">
    <div class="w-full max-w-[440px] bg-white border border-gray-200 rounded-[32px] p-8 md:p-10 shadow-2xl">
        
        <div class="mb-8">
            <h2 class="text-[36px] font-playfair font-bold text-gray-900 mb-2">Masuk</h2>
            <p class="text-[14px] text-gray-600 font-sans">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#c9a84c] font-semibold hover:text-yellow-600 transition-colors">Daftar sekarang &rarr;</a>
            </p>
        </div>

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
            <span class="text-red-500 mt-0.5"><i class="fas fa-exclamation-circle"></i></span>
            <ul class="text-red-600 text-xs space-y-1 font-sans">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6 font-sans">
            @csrf
            
            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2.5">Email</label>
                <div class="relative flex items-center group">
                    <span class="absolute left-4 text-[#c9a84c] text-[15px]">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-4 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2.5">Password</label>
                <div class="relative flex items-center group">
                    <span class="absolute left-4 text-[#c9a84c] text-[15px]">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-11 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
                    <button type="button" onclick="togglePass('password','eye1')"
                        class="absolute right-4 text-gray-400 hover:text-gray-600 text-[15px] transition-colors focus:outline-none">
                        <i id="eye1" class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-1">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded-sm border-gray-300 text-[#c9a84c] focus:ring-[#c9a84c] cursor-pointer">
                    <label for="remember" class="text-[13px] text-gray-600 cursor-pointer">Ingat saya</label>
                </div>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[13px] text-[#c9a84c] hover:text-yellow-600 transition-colors font-semibold">
                    Lupa password?
                </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-[#c9a84c] text-[#0e2118] font-bold py-4 rounded-xl text-[15px] shadow-lg hover:bg-yellow-500 transition-all">
                    Masuk Sekarang
                </button>
            </div>
        </form>

        <div class="flex items-center gap-4 my-7">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-[11px] text-gray-400 tracking-[2px] uppercase font-sans">atau</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <a href="{{ route('register') }}"
           class="flex items-center justify-center gap-2 w-full border border-gray-200 bg-white text-gray-700 text-[14px] font-semibold py-4 rounded-xl hover:bg-gray-50 transition-all">
            <i class="fas fa-user-plus text-[#c9a84c]"></i> Buat Akun Baru
        </a>
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