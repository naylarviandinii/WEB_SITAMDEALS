@extends('layouts.app')
@section('title', 'Status Pesanan – SiTamDeals')
@section('content')

<style>
    body {
        background-color: #050d09 !important;
        color: #ffffff;
    }

    .glass-panel {
        background-color: #0A1A12;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* State Style Pelacakan Sekuensial */
    .step-active {
        color: #e8c96a;
        font-weight: 700;
    }

    .step-done {
        color: #10b981;
    }

    .step-waiting {
        color: rgba(255, 255, 255, 0.2);
    }

    .bg-step-active {
        background-color: #e8c96a;
        color: #0e2118;
        box-shadow: 0 0 15px rgba(232, 201, 106, 0.4);
    }

    .bg-step-done {
        background-color: rgba(16, 185, 129, 0.2);
        border: 2px solid #10b981;
        color: #10b981;
    }

    .bg-step-waiting {
        background-color: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.2);
    }
</style>

<div class="max-w-4xl mx-auto py-16 px-6 font-sans">

    <div class="glass-panel rounded-2xl p-8 md:p-10 shadow-2xl relative overflow-hidden">

        <div class="text-center border-b border-white/10 pb-8 mb-10">
            <span class="text-[10px] border border-white/30 px-3 py-1 rounded-full font-mono uppercase tracking-widest text-white/70">
                Nota Transaksi: #ORDER-{{ $order->id }}
            </span>
            <h2 class="text-3xl font-playfair font-bold text-white mt-4">Pelacakan Pesanan Anda</h2>
            <p class="text-sm text-white/60 mt-1">Status diperbarui berkala oleh kasir ritel Tambah Jaya.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10 mb-12">

            {{-- STEP 1: PENDING (DITERIMA) --}}
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-base mb-3 font-mono font-bold
                    {{ $order->status == 'pending' ? 'bg-step-active' : 'bg-step-done' }}">
                    @if($order->status != 'pending') <i class="fas fa-check"></i> @else 1 @endif
                </div>
                <p class="text-xs uppercase tracking-wider {{ $order->status == 'pending' ? 'step-active' : 'step-done' }}">Diterima</p>
            </div>

            {{-- STEP 2: DIPROSES --}}
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-base mb-3 font-mono font-bold
                    {{ $order->status == 'proses' ? 'bg-step-active' : (in_array($order->status, ['diambil_dibayar', 'selesai']) ? 'bg-step-done' : 'bg-step-waiting') }}">
                    @if(in_array($order->status, ['diambil_dibayar', 'selesai'])) <i class="fas fa-check"></i> @else 2 @endif
                </div>
                <p class="text-xs uppercase tracking-wider {{ $order->status == 'proses' ? 'step-active' : (in_array($order->status, ['diambil_dibayar', 'selesai']) ? 'step-done' : 'step-waiting') }}">Diproses</p>
            </div>

            {{-- STEP 3: AMBIL & BAYAR --}}
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-base mb-3 font-mono font-bold
                    {{ $order->status == 'diambil_dibayar' ? 'bg-step-active' : ($order->status == 'selesai' ? 'bg-step-done' : 'bg-step-waiting') }}">
                    @if($order->status == 'selesai') <i class="fas fa-check"></i> @else 3 @endif
                </div>
                <p class="text-xs uppercase tracking-wider {{ $order->status == 'diambil_dibayar' ? 'step-active' : ($order->status == 'selesai' ? 'step-done' : 'step-waiting') }}">Ambil & Bayar</p>
            </div>

            {{-- STEP 4: SELESAI --}}
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-base mb-3 font-mono font-bold
                    {{ $order->status == 'selesai' ? 'bg-step-active' : 'bg-step-waiting' }}">
                    4
                </div>
                <p class="text-xs uppercase tracking-wider {{ $order->status == 'selesai' ? 'step-active' : 'step-waiting' }}">Selesai</p>
            </div>

        </div>

        {{-- AREA NOTIFIKASI DINAMIS --}}
        @if($order->status == 'selesai')
        <div class="bg-emerald-950/40 border border-emerald-500/30 rounded-2xl p-6 text-center flex flex-col items-center justify-center gap-4">
            <div class="w-14 h-14 bg-emerald-500 text-[#050d09] rounded-full flex items-center justify-center text-2xl shadow-lg">
                <i class="fas fa-handshake"></i>
            </div>
            <div>
                <h4 class="text-xl font-bold text-white font-playfair">Pesanan Anda Telah Selesai!</h4>
                <p class="text-xs text-white/70 mt-1">Pembayaran terverifikasi lunas dan barang telah berhasil diserahterimakan.</p>
            </div>

            <a href="/orders/{{ $order->id }}/invoice-customer" target="_blank"
                class="mt-2 inline-flex items-center justify-center gap-2 bg-[#e8c96a] text-[#0e2118] font-bold text-xs uppercase tracking-wider px-8 py-3.5 rounded-xl shadow-md hover:opacity-90 transition-all">
                <i class="fas fa-file-invoice text-[11px]"></i> Lihat Invoice Resmi
            </a>
        </div>
        @elseif($order->status == 'diambil_dibayar')
        <div class="bg-emerald-950/40 border border-emerald-500/30 rounded-2xl p-6 text-center flex flex-col items-center justify-center gap-4">
            <div class="w-14 h-14 bg-emerald-500 text-[#050d09] rounded-full flex items-center justify-center text-2xl shadow-lg">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div>
                <h4 class="text-xl font-bold text-white font-playfair">Invoice Tersedia!</h4>
                <p class="text-xs text-white/70 mt-1">Pesanan siap diambil di gerai. Silakan tunjukkan rincian invoice kepada kasir untuk menyelesaikan pembayaran.</p>
            </div>

            <!-- <a href="/admin/orders/{{ $order->id }}/invoice" target="_blank" -->
            <a href="{{route('orders.invoice', $order->id)}}" target="_blank"
                class="mt-2 inline-flex items-center justify-center gap-2 bg-[#e8c96a] text-[#0e2118] font-bold text-xs uppercase tracking-wider px-8 py-3.5 rounded-xl shadow-md hover:opacity-90 transition-all">
                <i class="fas fa-file-invoice text-[11px]"></i> Lihat Invoice
            </a>
        </div>
        @else
        {{-- Aktif jika status masih 'pending' atau 'proses' --}}
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 flex items-center justify-center gap-3">
            <i class="fas fa-circle-notch animate-spin text-[#e8c96a] text-sm"></i>
            <p class="text-xs text-white/70 tracking-wide">Mohon tunggu, tim Tambah Jaya sedang memproses kelengkapan item Anda...</p>
        </div>
        @endif

    </div>
</div>
@endsection