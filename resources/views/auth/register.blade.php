@extends('layouts.app')
@section('title', 'SiTamDeals – Daftar Akun Baru')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background-color: #050d09;
    }

    .font-playfair { font-family: 'Playfair Display', serif; }

    /* Left Panel Gradient */
    .bg-luxury-gradient {
        background: radial-gradient(circle at top left, #112d1d 0%, #050d09 100%);
    }

    /* Stats Card Style */
    .stats-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }
    .stats-card:hover { transform: translateY(-5px); }

    /* White Form Card */
    .form-card {
        background: #ffffff;
        border-radius: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    /* Input Style matching Login */
    .input-custom {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }
    .input-custom:focus {
        outline: none;
        border-color: #e8c96a;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(232, 201, 106, 0.1);
    }

    .btn-gold-luxury {
        background: #c9a84c;
        color: #fff;
        font-weight: 700;
        border-radius: 12px;
        padding: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(201, 168, 76, 0.2);
    }
    .btn-gold-luxury:hover {
        background: #e8c96a;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen flex flex-col lg:flex-row bg-luxury-gradient overflow-x-hidden">
    
    <div class="lg:w-3/5 p-8 lg:p-20 flex flex-col justify-between relative">
        <div class="mb-10">
            <div class="inline-flex items-center gap-2 bg-[#1a3d2b] border border-white/10 px-4 py-2 rounded-full">
                <span class="text-[#e8c96a] text-xs">✦</span>
                <span class="text-white text-[10px] font-bold tracking-widest uppercase">Simalayan Tambah Jaya</span>
            </div>
        </div>

        <div class="max-w-2xl">
            <h1 class="font-playfair text-white text-6xl lg:text-8xl font-black leading-tight mb-6">
                Selamat <br> Datang <br> <span class="text-[#e8c96a]">Baru</span>
            </h1>
            <p class="text-white/60 text-lg max-w-md">
                Daftar akun kamu dan nikmati ribuan produk berkualitas dengan harga transparan dari Tambah Jaya.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-12 lg:mt-0">
            <div class="stats-card flex items-center gap-4">
                <div class="p-3 bg-white/10 rounded-xl text-[#e8c96a]">📦</div>
                <div>
                    <p class="text-white font-bold text-xl">1000+</p>
                    <p class="text-white/40 text-[10px] uppercase">Produk</p>
                </div>
            </div>
            <div class="stats-card flex items-center gap-4">
                <div class="p-3 bg-white/10 rounded-xl text-[#e8c96a]">👥</div>
                <div>
                    <p class="text-white font-bold text-xl">10K+</p>
                    <p class="text-white/40 text-[10px] uppercase">Pelanggan</p>
                </div>
            </div>
            <div class="stats-card flex items-center gap-4">
                <div class="p-3 bg-white/10 rounded-xl text-[#e8c96a]">⭐️</div>
                <div>
                    <p class="text-white font-bold text-xl">4,9★</p>
                    <p class="text-white/40 text-[10px] uppercase">Rating</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:w-2/5 p-6 lg:p-12 flex items-center justify-center">
        <div class="form-card w-full max-w-md p-10">
            <div class="mb-8">
                <h2 class="font-playfair text-4xl font-black text-gray-900 mb-2">Daftar</h2>
                <p class="text-gray-400 text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-[#c9a84c] font-bold hover:underline">Masuk sekarang —</a>
                </p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="John Doe" required
                        class="input-custom w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                    @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Email</label>
                    <input type="email" name="email" placeholder="name@email.com" required
                        class="input-custom w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Password</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="input-custom w-full @error('password') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required
                        class="input-custom w-full">
                </div>

                <button type="submit" class="btn-gold-luxury w-full mt-4 uppercase tracking-widest text-sm">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                <p class="text-gray-400 text-[11px] mb-4 uppercase tracking-widest">Atau</p>
                <a href="{{ route('login') }}" class="flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-2xl text-gray-600 text-sm font-bold hover:bg-gray-50 transition">
                    <span class="text-gray-300">←</span> Sudah Punya Akun
                </a>
            </div>
        </div>
    </div>
</div>
@endsection