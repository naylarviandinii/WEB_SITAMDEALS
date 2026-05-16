@extends('layouts.app')
@section('title', 'Keranjang – SiTamDeals')
@section('content')
<div class="max-w-4xl mx-auto py-16 px-6">
    <h1 class="font-playfair text-3xl font-black text-forest mb-8">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-xl mb-6">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-4">🛒</div>
            <p class="text-gray-400">Keranjang masih kosong.</p>
            <a href="/products" class="mt-4 inline-block bg-forest text-white px-6 py-3 rounded-xl font-bold">Mulai Belanja</a>
        </div>
    @else
        <div class="space-y-4 mb-8">
            @foreach($items as $item)
            <div class="bg-white rounded-2xl p-5 flex items-center gap-5 shadow-sm border border-gray-100">
                <img src="/img/{{ $item->product->image }}" class="w-16 h-16 object-cover rounded-xl" onerror="this.src='https://via.placeholder.com/64'">
                <div class="flex-1">
                    <p class="font-bold text-forest">{{ $item->product->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Grade {{ $item->grade }} &nbsp;•&nbsp; {{ $item->qty }} unit</p>
                    <p class="text-sage font-bold mt-1">Rp {{ number_format($item->unit_price, 0, ',', '.') }} / unit</p>
                </div>
                <div class="text-right">
                    <p class="font-black text-forest text-lg">Rp {{ number_format($item->unit_price * $item->qty, 0, ',', '.') }}</p>
                    <form action="/cart/{{ $item->id }}" method="POST" class="mt-2">
                        @csrf @method('DELETE')
                        <button class="text-red-400 text-xs hover:text-red-600 font-semibold">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Total & Checkout -->
        <div class="bg-white rounded-2xl shadow-xl p-6 flex justify-between items-center border border-gray-100">
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Total Belanja</p>
                <p class="font-playfair text-3xl font-black text-sage">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>
            <form action="/cart/checkout" method="POST">
                @csrf
                <button type="submit" class="bg-gold text-forest font-black px-8 py-4 rounded-2xl shadow-lg hover:bg-gold-dark transition">
                    <i class="fas fa-shopping-bag mr-2"></i>Checkout Semua
                </button>
            </form>
        </div>
    @endif
</div>
@endsection