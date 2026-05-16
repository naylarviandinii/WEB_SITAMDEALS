@extends('layouts.app')
@section('title', 'Riwayat – SiTamDeals')
@section('content')
<div class="max-w-4xl mx-auto py-16 px-6">
    <h1 class="font-playfair text-3xl font-black text-forest mb-8">Riwayat Transaksi</h1>

    @if($orders->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-4">📋</div>
            <p class="text-gray-400">Belum ada transaksi.</p>
        </div>
    @else
        <div class="space-y-5">
            @foreach($orders as $order)
            @php
                $total = $order->items->sum(fn($i) => $i->price * $i->qty);
                $statusColor = match($order->status) {
                    'selesai'  => 'bg-green-100 text-green-700',
                    'pending'  => 'bg-yellow-100 text-yellow-700',
                    'diproses' => 'bg-blue-100 text-blue-700',
                    'ditolak'  => 'bg-red-100 text-red-700',
                    default    => 'bg-gray-100 text-gray-600',
                };
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Header order -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-50">
                    <div>
                        <p class="font-mono font-bold text-gray-800">#STD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-bold px-3 py-1 rounded-full uppercase {{ $statusColor }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        <a href="/invoice/{{ $order->id }}" class="text-sage text-sm font-bold hover:underline">Lihat Invoice →</a>
                    </div>
                </div>
                <!-- Item list -->
                <div class="px-6 py-4 space-y-2">
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $item->product->name }} <span class="text-gray-400">(Grade {{ $item->grade }} × {{ $item->qty }})</span></span>
                        <span class="font-semibold text-forest">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                <!-- Footer total -->
                <div class="px-6 py-3 bg-gray-50 flex justify-between items-center">
                    <span class="text-xs text-gray-400 uppercase font-bold tracking-widest">Total</span>
                    <span class="font-black text-sage">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection