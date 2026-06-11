@extends('layouts.app')
@section('title', 'Keranjang – SiTamDeals')
@section('content')

<style>
    /* Mengubah background body menjadi off-white yang bersih */
    body {
        background-color: #f8faf9 !important; 
        color: #050d09 !important;
    }
    /* Mengubah panel menjadi putih dengan efek transparan lembut */
    .glass-panel {
        background-color: rgba(255, 255, 255, 0.8); 
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease; /* Tambahan untuk animasi shadow */
    }
    /* Efek shadow (timbul) saat di-hover */
    .glass-panel:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .btn-gold {
        background-color: #e8c96a;
        color: #0e2118;
        border-radius: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-gold:hover {
        background-color: #f3da83;
    }
</style>

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 font-sans antialiased">
    <div class="flex items-center justify-between mb-8 border-b border-black/5 pb-4">
        <div>
            <h1 class="font-playfair text-3xl sm:text-4xl font-extrabold tracking-tight text-[#050d09]">Keranjang Belanja</h1>
            <p class="text-xs sm:text-sm text-[#050d09]/60 mt-1">Periksa kembali item pilihan Anda sebelum melakukan checkout.</p>
        </div>
        <div class="text-right hidden sm:block">
            <span class="text-xs font-mono bg-black/5 border border-black/10 px-3 py-1.5 rounded-full text-[#050d09]/70">
                {{ $items->count() }} Jenis Produk
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
            <i class="fas fa-check-circle text-base"></i> 
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($items->isEmpty())
        <div class="glass-panel rounded-2xl text-center py-20 px-6">
            <div class="text-6xl mb-4 select-none">🛒</div>
            <h3 class="text-lg font-bold text-[#050d09] font-playfair">Wah, keranjangmu masih kosong</h3>
            <p class="text-[#050d09]/50 text-xs sm:text-sm mt-2 max-w-sm mx-auto">Yuk, kembali jelajahi katalog produk unggulan SiTamDeals.</p>
            <a href="/products" class="mt-8 inline-block btn-gold px-8 py-3 text-xs font-bold uppercase tracking-wider">
                <i class="fas fa-arrow-left mr-1.5 text-[10px]"></i> Mulai Belanja
            </a>
        </div>
    @else
        <form action="/cart/checkout" method="POST">
            @csrf
            <div class="space-y-4 mb-8">
                @foreach($items as $item)
                <div class="glass-panel rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-colors">
                    <div class="flex items-center gap-4 sm:gap-5 flex-1">
<input type="checkbox" name="selected_items[]" value="{{ $item->id }}"
    {{ (isset($buyNowId) && $buyNowId == $item->id) ? 'checked' : '' }}
    class="cart-checkbox">                        
                        <img src="/img/{{ $item->product->image }}" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-xl border border-black/5" onerror="this.src='https://via.placeholder.com/80'">
                        
                        <div class="flex-1 min-w-0">
                            <p class="font-playfair text-lg sm:text-xl font-bold text-[#050d09] truncate">{{ $item->product->name }}</p>
                            <div class="flex flex-wrap items-center gap-x-3 mt-1 text-xs">
                                <span class="text-emerald-700 font-mono font-bold bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">
                                    Grade {{ $item->grade }}
                                </span>
                                <span class="text-[#050d09]/60">Jumlah: <strong class="text-[#050d09] font-mono">{{ $item->qty }} unit</strong></span>
                            </div>
                            <p class="text-[#050d09]/80 font-mono text-xs font-semibold mt-1.5">
                                Rp {{ number_format($item->unit_price, 0, ',', '.') }} / unit
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex sm:flex-col items-center sm:items-end justify-between border-t sm:border-t-0 border-black/5 pt-3 sm:pt-0">
                        <div class="text-right">
                            <p class="font-black text-[#050d09] font-mono text-base sm:text-xl">
                                Rp {{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}
                            </p>
                            <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();" class="text-red-500/70 text-[11px] hover:text-red-600 font-bold uppercase tracking-wider flex items-center gap-1">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="glass-panel rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row justify-between items-center gap-4 border border-black/5">
                <div class="text-center sm:text-left">
                    <p class="text-[10px] text-[#050d09]/50 uppercase font-bold tracking-widest">Total Estimasi Belanja</p>
                    <p class="font-playfair text-3xl sm:text-4xl font-black text-[#050d09] font-mono tracking-tight mt-0.5">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>
                <button type="submit" class="btn-gold w-full sm:w-auto px-8 py-4 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                    <i class="fas fa-shopping-bag text-[11px]"></i> Checkout Produk Terpilih
                </button>
            </div>
        </form>

        @foreach($items as $item)
            <form id="delete-form-{{ $item->id }}" action="/cart/{{ $item->id }}" method="POST" class="hidden">
                @csrf @method('DELETE')
            </form>
        @endforeach
    @endif
</div>
@endsection