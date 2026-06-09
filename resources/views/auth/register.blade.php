@extends('layouts.app')
@section('title', 'Buat Akun – SiTamDeals')

@section('content')
<section class="min-h-[calc(100vh-72px)] flex items-center justify-center p-6 bg-[#0A1A12]">

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#1a4a2e] rounded-full filter blur-[120px] opacity-60 pointer-events-none"></div>
    <div class="absolute top-[20%] right-[0%] w-[40%] h-[50%] bg-[#c9a84c] rounded-full filter blur-[150px] opacity-20 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[20%] w-[40%] h-[40%] bg-[#0e2118] rounded-full filter blur-[100px] opacity-90 pointer-events-none"></div>

    <div class="grid lg:grid-cols-2 gap-16 w-full max-w-6xl items-center">
        
        <div class="hidden lg:flex flex-col justify-center text-white">
            <h1 class="font-['Playfair_Display'] text-[64px] font-bold leading-[1.1] mb-6">
                Gabung &<br><span class="italic text-[#c9a84c]">Mulai Hemat</span><br>Hari Ini
            </h1>
            <p class="text-white/70 max-w-sm mb-12">
                Daftarkan diri Anda untuk menikmati kemudahan berbelanja dengan harga transparan di Swalayan Tambah Jaya.
            </p>
        </div>

<div class="w-full lg:w-4/5 flex items-center justify-center relative z-10 px-4">
    <div class="w-full max-w-[650px] bg-white border border-gray-200 rounded-[32px] p-10 md:p-14 shadow-2xl mx-auto">
        
        <div class="mb-10 text-center">
            <h2 class="font-['Playfair_Display'] text-[40px] font-bold text-gray-900 mb-2">Buat Akun</h2>
            <p class="text-[15px] text-gray-600 font-sans">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-[#c9a84c] font-semibold hover:text-yellow-600 transition-colors">Masuk di sini &rarr;</a>
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6 font-sans">
            @csrf
            
            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama Anda" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-4 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2">Email</label>
                <input type="email" name="email" required placeholder="nama@email.com" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-4 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-4 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
            </div>

            <div>
                <label class="block text-[11px] font-bold tracking-[1.5px] uppercase text-gray-500 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-4 text-[15px] text-gray-900 placeholder-gray-400 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c] outline-none transition-all">
            </div>

            <button type="submit" class="w-full bg-[#c9a84c] text-white font-bold py-4 rounded-xl hover:bg-yellow-600 transition-all shadow-lg mt-6 text-[16px]">
                Daftar Sekarang
            </button>
        </form>
    </div>
</div>
</section>
@endsection