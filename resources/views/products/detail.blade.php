@extends('layouts.app')
@section('title', 'Detail – ' . $product->name)

@push('styles')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    .qty-btn { transition: all 0.2s; }
    .qty-btn:active { transform: scale(0.88); }
</style>
@endpush

@section('content')

<div class="max-w-6xl mx-auto pt-12 pb-20 px-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-8">
        <a href="{{ route('home') }}" class="hover:text-gold transition">Home</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <a href="{{ route('products') }}" class="hover:text-gold transition">Produk</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <span class="text-forest font-semibold">{{ Str::limit($product->name, 30) }}</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-10 items-start">

        {{-- ===== KIRI: GAMBAR ===== --}}
        <div class="sticky top-24">
            <div class="rounded-3xl overflow-hidden shadow-xl bg-white p-6 border border-gray-100">
                @if($product->image && file_exists(public_path('img/'.$product->image)))
                    <img src="{{ asset('img/'.$product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-[360px] object-contain">
                @else
                    <div class="w-full h-[360px] flex flex-col items-center justify-center text-gray-200">
                        <span class="text-8xl">🛒</span>
                        <span class="text-xs mt-4 italic text-gray-300">Gambar Belum Tersedia</span>
                    </div>
                @endif
            </div>

            {{-- Badge stok per grade --}}
            <div class="flex gap-3 mt-4 justify-center">
                @foreach(['A','B','C'] as $g)
                @php
                    $stok = $product->{'stock_'.$g};
                    $warna = $stok > 0 ? 'bg-sage/10 border-sage/20 text-sage' : 'bg-gray-100 border-gray-200 text-gray-300';
                @endphp
                <div class="flex-1 border rounded-xl py-2.5 text-center {{ $warna }}">
                    <div class="text-[9px] font-black uppercase tracking-widest">Grade {{ $g }}</div>
                    <div class="font-bold text-sm mt-0.5">{{ $stok > 0 ? $stok.' stok' : 'Habis' }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ===== KANAN: INFO & ORDER ===== --}}
        <div>
            <span class="text-[9px] font-bold text-sage/50 uppercase tracking-[2px]">Tambah Jaya</span>
            <h1 class="font-playfair text-4xl font-black text-forest mt-1 mb-3 leading-tight">
                {{ $product->name }}
            </h1>

            {{-- Harga --}}
            <div id="price-display" class="text-3xl font-black text-sage mb-1">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
            <div class="text-sm text-gray-400 mb-6 italic">
                Harga Normal: Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            {{-- Pilih Grade --}}
            <div class="mb-5">
                <label class="block text-xs font-black mb-2.5 text-forest/70 uppercase tracking-widest">
                    Pilih Grade Kondisi Barang
                </label>
                <select id="grade" onchange="refreshUI()"
                        class="w-full border border-mint p-3.5 rounded-2xl focus:ring-2 focus:ring-sage bg-white text-sm shadow-sm outline-none font-medium">
                    <option value="">-- Pilih Grade --</option>
                    <option value="A">Grade A — Lecet Halus (Diskon 15%)</option>
                    <option value="B">Grade B — Penyok / Kardus Rusak (Diskon 30%)</option>
                    <option value="C">Grade C — Repack / Dekat Expired (Diskon 50%)</option>
                </select>
                <p id="stock-display" class="hidden text-[11px] font-bold text-orange-500 mt-2">
                    <i class="fas fa-boxes mr-1"></i>
                    Stok Tersedia: <span id="stock-count">0</span> unit
                </p>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <p class="text-gray-500 text-sm leading-relaxed mb-5">
                    {{ Str::before($product->description, '.') . '.' }}
                </p>
                <div class="space-y-2">
                    <p class="text-[9px] font-black text-sage uppercase tracking-widest mb-2">Detail per Grade:</p>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach([
                            ['A', 'Kemasan mulus, sisa event. Diskon 15%.'],
                            ['B', 'Kardus penyok, expired > 4 bln. Diskon 30%.'],
                            ['C', 'Kemasan repack, expired dekat. Diskon 50%.'],
                        ] as [$g, $keterangan])
                        <div class="bg-white/60 border border-mint/40 rounded-xl p-2.5 text-[11px] text-gray-500 flex gap-2 items-start">
                            <span class="font-black text-forest bg-gold/20 text-[9px] px-1.5 py-0.5 rounded-md">{{ $g }}</span>
                            {{ $keterangan }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Quantity + Subtotal --}}
            <div class="bg-white rounded-2xl shadow-lg p-4 mb-4 flex items-center justify-between border border-gray-100">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="changeQty(-1)"
                            class="qty-btn w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center font-bold text-forest shadow-sm">
                        <i class="fas fa-minus text-xs"></i>
                    </button>
                    <div class="text-center w-14">
                        <div class="text-[9px] text-gray-400 uppercase font-black">Qty</div>
                        <div id="qty-display" class="font-black text-2xl text-forest">0</div>
                    </div>
                    <button type="button" onclick="changeQty(1)"
                            class="qty-btn w-10 h-10 bg-sage hover:bg-forest rounded-full flex items-center justify-center font-bold text-white shadow-md">
                        <i class="fas fa-plus text-xs"></i>
                    </button>
                </div>
                <div class="text-right">
                    <div class="text-[9px] text-gray-400 uppercase font-black">Subtotal</div>
                    <div id="subtotal-display" class="text-2xl font-black text-sage">Rp 0</div>
                </div>
            </div>

            {{-- Form: Tambah ke Keranjang --}}
            <form action="{{ route('cart.add') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                <input type="hidden" name="grade"      id="h-grade">
                <input type="hidden" name="qty"        id="h-qty" value="0">
                <input type="hidden" name="unit_price" id="h-unit-price" value="{{ $product->price }}">

                <button type="submit"
                        class="w-full bg-gold text-forest font-black py-4 rounded-2xl shadow-lg hover:bg-yellow-400 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-3 text-base">
                    <i class="fas fa-cart-plus"></i>
                    Tambah ke Keranjang
                    <span id="checkout-qty" class="bg-forest/20 text-xs px-2 py-0.5 rounded-full">0 item</span>
                </button>
            </form>

            {{-- Tombol Checkout langsung --}}
            <div class="mt-3 text-center">
                <a href="{{ route('cart') }}"
                   class="text-xs text-gray-400 hover:text-forest transition font-semibold">
                    <i class="fas fa-shopping-cart mr-1"></i>Lihat Keranjang →
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const stocks = {
    "A": {{ intval($product->stock_A) }},
    "B": {{ intval($product->stock_B) }},
    "C": {{ intval($product->stock_C) }},
};
const basePrice = {{ intval($product->price) }};
let qty = 0;

function refreshUI() {
    const g    = document.getElementById('grade').value;
    const sdEl = document.getElementById('stock-display');
    const scEl = document.getElementById('stock-count');

    if (g && stocks[g] !== undefined) {
        sdEl.classList.remove('hidden');
        scEl.innerText = stocks[g];
        if (qty > stocks[g]) qty = stocks[g];
    } else {
        sdEl.classList.add('hidden');
    }

    const multiplier = { A: 0.85, B: 0.70, C: 0.50 }[g] ?? 1;
    const unitPrice  = Math.floor(basePrice * multiplier);
    const subtotal   = unitPrice * qty;

    document.getElementById('price-display').innerText   = 'Rp ' + unitPrice.toLocaleString('id-ID');
    document.getElementById('qty-display').innerText     = qty;
    document.getElementById('subtotal-display').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('checkout-qty').innerText    = qty + ' item';

    document.getElementById('h-grade').value      = g;
    document.getElementById('h-qty').value        = qty;
    document.getElementById('h-unit-price').value = unitPrice;
}

function changeQty(delta) {
    const g = document.getElementById('grade').value;
    if (!g) { alert('Pilih Grade dulu!'); return; }

    let next = qty + delta;
    if (next < 0) next = 0;
    if (next > stocks[g]) {
        alert('Stok Grade ' + g + ' hanya ' + stocks[g] + ' unit!');
        next = stocks[g];
    }
    qty = next;
    refreshUI();
}

function validateForm() {
    if (!document.getElementById('grade').value) { alert('Pilih Grade dulu!'); return false; }
    if (qty <= 0) { alert('Qty masih 0!'); return false; }
    return true;
}
</script>
@endpush