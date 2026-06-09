@extends('layouts.app')
@section('title', 'Keranjang – SiTamDeals')
@section('content')

<style>
    body {
        background-color: #050d09 !important;
        color: #ffffff;
    }
    .glass-panel {
        background-color: rgba(10, 26, 18, 0.7); 
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .btn-gold {
        background-color: #e8c96a;
        color: #0e2118;
        border-radius: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-gold:hover {
        background-color: #f3da83;
        transform: translateY(-1px);
        box-shadow: 0 4px 20px rgba(232, 201, 106, 0.25);
    }
    .btn-gold:active {
        transform: translateY(0);
    }
</style>

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 font-sans antialiased">
    <div class="flex items-center justify-between mb-8 border-b border-white/5 pb-4">
        <div>
            <h1 class="font-playfair text-3xl sm:text-4xl font-extrabold tracking-tight text-white">Keranjang Belanja</h1>
            <p class="text-xs sm:text-sm text-white/50 mt-1">Periksa kembali item pilihan Anda sebelum melakukan checkout.</p>
        </div>
        <div class="text-right hidden sm:block">
            <span class="text-xs font-mono bg-white/5 border border-white/10 px-3 py-1.5 rounded-full text-white/70">
                {{ $items->count() }} Jenis Produk
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
            <i class="fas fa-check-circle text-base"></i> 
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($items->isEmpty())
        <div class="glass-panel rounded-2xl text-center py-20 px-6 shadow-2xl">
            <div class="text-6xl mb-4 select-none">🛒</div>
            <h3 class="text-lg font-bold text-white font-playfair">Wah, keranjangmu masih kosong</h3>
            <p class="text-white/40 text-xs sm:text-sm mt-2 max-w-sm mx-auto">Yuk, kembali jelajahi katalog produk unggulan SiTamDeals dan temukan penawaran terbaik hari ini.</p>
            <a href="/products" class="mt-8 inline-block btn-gold px-8 py-3 text-xs font-bold uppercase tracking-wider shadow-md">
                <i class="fas fa-arrow-left mr-1.5= text-[10px]"></i> Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-4 mb-8">
            @foreach($items as $item)
            <div class="glass-panel rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl hover:border-white/15 transition-colors duration-300">
                
                <div class="flex items-center gap-4 sm:gap-5 flex-1">
                    <div class="flex-shrink-0">
                        <img src="/img/{{ $item->product->image }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-xl border border-white/10 shadow-inner" onerror="this.src='https://via.placeholder.com/80'">
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <p class="font-playfair text-lg sm:text-xl font-bold text-white truncate tracking-wide">{{ $item->product->name }}</p>
                        
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1 text-xs">
                            <span class="text-emerald-400 font-mono font-bold uppercase tracking-wider bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">
                                Grade {{ $item->grade }}
                            </span>
                            <span class="text-white/50">
                                Jumlah: <strong class="text-white/80 font-mono">{{ $item->qty }}  unit</strong>
                            </span>
                        </div>
                        
                        <p class="text-[#e8c96a]/90 font-mono text-xs font-semibold mt-1.5">
                            Rp {{ number_format($item->unit_price, 0, ',', '.') }} <span class="text-white/30 font-sans font-normal">/ unit</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 border-t sm:border-t-0 border-white/5 pt-3 sm:pt-0">
                    <span class="text-white/40 text-xs sm:hidden font-medium">Subtotal:</span>
                    <div class="text-right">
                        <p class="font-black text-white font-mono text-base sm:text-xl tracking-tight">
                            Rp {{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}
                        </p>
                        <form action="/cart/{{ $item->id }}" method="POST" class="mt-1 sm:mt-1.5 m-0 p-0">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="text-red-400/80 text-[11px] hover:text-red-400 font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors group">
                                <i class="fas fa-trash-alt text-[10px] transform group-hover:scale-110 transition-transform"></i> 
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="glass-panel rounded-2xl shadow-2xl p-5 sm:p-6 flex flex-col sm:flex-row justify-between items-center gap-4 w-full border border-white/10 bg-gradient-to-r from-[#0A1A12] to-[#06150e]">
            <div class="text-center sm:text-left w-full sm:w-auto">
                <p class="text-[10px] text-white/40 uppercase font-bold tracking-widest">Total Estimasi Belanja</p>
                <p class="font-playfair text-3xl sm:text-4xl font-black text-[#e8c96a] font-mono tracking-tight mt-0.5">
                    Rp {{ number_format($total, 0, ',', '.') }}
                </p>
            </div>
            
            <div class="w-full sm:w-auto">
                <form action="/cart/checkout" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="btn-gold w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2 shadow-xl">
                        <i class="fas fa-shopping-bag text-[11px] opacity-90"></i> 
                        <span>Checkout Semua</span>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection