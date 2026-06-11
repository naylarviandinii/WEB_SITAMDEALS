<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Status Pemesanan - SitamDeals</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;700&display=swap');
        body { background-color: #050d09; color: #ffffff; font-family: 'Inter', 'Playfair Display'; }
        .glass-panel { background-color: #0A1A12; border: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-flow-active { background-color: #e8c96a; color: #0e2118; border: 1px solid #e8c96a; font-weight: 700; }
    </style>
</head>
<body class="py-6 px-4 md:px-8">
    <nav class="glass-card sticky top-2 z-50 px-6 py-3 flex justify-between items-center border-b border-white/10 shadow-lg">
    {{-- Sisi Kiri: Logo SitamDeals & Badge Kasir --}}
    <div class="flex items-center gap-3">
        <span class="text-2xl font-playfair font-black text-white tracking-wide">
            SiTam<span class="text-[#c9a84c]">Deals</span>
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/[0.04] border border-[#c9a84c]/50 text-[#c9a84c] text-[10px] font-bold tracking-[1.5px] uppercase font-sans">
            ✦ Kasir
        </span>
    </div>

    {{-- Sisi Kanan: Form Tombol Kelola Logout --}}
    <form action="/logout" method="POST" class="m-0">
        @csrf
        <button type="submit" class="text-sm font-semibold text-white/70 hover:text-rose-400 transition-all flex items-center gap-2 group">
            <i class="fas fa-sign-out-alt text-xs group-hover:translate-x-1 transition-transform"></i> Keluar
        </button>
    </form>
</nav>
        
        <div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/10 bg-white/[0.02]">
                        <th class="p-5 text-xs font-bold uppercase text-white/70">ID</th>
                        <th class="p-5 text-xs font-bold uppercase text-white/70">Pelanggan</th>
                        <th class="p-5 text-xs font-bold uppercase text-white/70">Total</th>
                        <th class="p-5 text-xs font-bold uppercase text-white/70 text-center">Status</th>
                        <th class="p-5 text-xs font-bold uppercase text-white/70 text-center">Alur Progress</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($orders as $order)
                    <tr>
                        <td class="p-5 font-mono font-bold text-amber-400">#{{ $order->id }}</td>
                        <td class="p-5 font-semibold">{{ $order->customer_name }}</td>
                        <td class="p-5 font-mono">
                            Rp {{ number_format($order->items->sum(fn($i) => $i->price * $i->qty), 0, ',', '.') }}
                        </td>
                        <td class="p-5 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] uppercase bg-amber-500/10 border border-amber-500/30 text-[#e8c96a]">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-5">
                            <div class="flex items-center gap-1 justify-center">
                                {{-- Loop hanya merender 2 tombol status fisik --}}
                                @foreach(['diterima' => 'Diterima', 'diproses' => 'Diproses'] as $key => $label)
                                    <form method="POST" action="/admin/orders/{{ $order->id }}/update-status">
                                        @csrf @method('PATCH')
                                        <button type="submit" name="status" value="{{ $key }}"
                                            class="px-3 py-2 rounded-xl text-[10px] font-bold uppercase transition-all {{ $order->status == $key ? 'btn-flow-active' : 'bg-white/5 text-white/40 hover:bg-white/10' }}">
                                            {{ $label }}
                                        </button>
                                    </form>
                                    <i class="fas fa-chevron-right text-white/10 text-[10px]"></i>
                                @endforeach

                                {{-- Form Ambil & Bayar mandiri (hidden secara visual, dipanggil lewat tombol print) --}}
                                <form method="POST" action="/admin/orders/{{ $order->id }}/update-status" id="form-ambil-{{ $order->id }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="diambil_dibayar">
                                </form>

                                {{-- Tombol Invoice --}}
                                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" onclick="document.getElementById('form-ambil-{{ $order->id }}').submit();"
                                   class="ml-2 px-3 py-2 rounded-xl text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500/20 transition-all">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>