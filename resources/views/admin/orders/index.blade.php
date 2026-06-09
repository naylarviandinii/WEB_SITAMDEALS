<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Status Pemesanan - SitamDeals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap');

        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }

        body {
            background-color: #050d09;
            color: #ffffff;
        }

        .glass-panel {
            background-color: #0A1A12; 
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Tombol yang aktif dan bisa diklik */
        .btn-flow-active {
            background-color: #e8c96a;
            color: #0e2118;
            border: 1px solid #e8c96a;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-flow-active:hover {
            background-color: #c9a84c;
            border-color: #c9a84c;
            transform: translateY(-1px);
        }

        /* Tombol yang sudah terlewati (Selesai) */
        .btn-flow-done {
            background-color: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #10b981;
            cursor: not-allowed;
        }

        /* Tombol yang masih terkunci (Belum Urutannya) */
        .btn-flow-disabled {
            background-color: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.2);
            cursor: not-allowed;
        }
    </style>
</head>
<body class="font-sans min-h-screen py-10 px-4 md:px-8">

    <div class="w-full max-w-7xl mx-auto">
        
        <div class="mb-8 border-b border-white/10 pb-6">
            <h2 class="text-4xl font-playfair font-bold text-white">Manajemen Status Pemesanan</h2>
            <p class="text-sm text-white/60 mt-1">Alur operational kasir wajib berurutan dari kiri ke kanan untuk menghindari kesalahan sistem.</p>
        </div>

        <div class="glass-panel rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10 bg-white/[0.02]">
                            <th class="p-5 text-xs font-bold uppercase tracking-wider text-white/70 w-[10%] text-center">ID</th>
                            <th class="p-5 text-xs font-bold uppercase tracking-wider text-white/70 w-[20%]">Pelanggan</th>
                            <th class="p-5 text-xs font-bold uppercase tracking-wider text-white/70 w-[15%]">Total</th>
                            <th class="p-5 text-xs font-bold uppercase tracking-wider text-white/70 w-[15%] text-center">Status Saat Ini</th>
                            <th class="p-5 text-xs font-bold uppercase tracking-wider text-white/70 w-[40%] text-center">Alur Progress Berurutan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        
                        @foreach($orders as $order)
                        <tr>
                            <td class="p-5 text-center font-mono font-bold text-amber-400 text-sm">#{{ $order->id }}</td>
                            <td class="p-5 text-base font-semibold text-white">{{ $order->customer_name }}</td>
<td class="p-5 text-base font-mono text-white/90">
    Rp {{ number_format($order->items->sum(fn($item) => $item->price * $item->qty), 0, ',', '.') }}
</td>                            
                            <td class="p-5 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold font-mono uppercase bg-amber-500/10 border border-amber-500/30 text-[#e8c96a]">
                                    {{ $order->status }}
                                </span>
                            </td>
                            
                            <td class="p-5">
                                <form method="POST" action="/admin/orders/{{ $order->id }}/update-status" class="flex items-center gap-2 justify-center w-full">
    @csrf
    @method('PATCH')

    {{-- Tombol Diterima --}}
    <button type="submit" name="status" value="diterima"
        class="px-3 py-2 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-1 transition-all
        {{ $order->status == 'diterima' ? 'btn-flow-active' : 'bg-white/5 text-white/50 hover:bg-white/10' }}">
        Diterima
    </button>

    <i class="fas fa-chevron-right text-white/20 text-xs"></i>

    {{-- Tombol Diproses --}}
    <button type="submit" name="status" value="diproses"
        class="px-3 py-2 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-1 transition-all
        {{ $order->status == 'diproses' ? 'btn-flow-active' : 'bg-white/5 text-white/50 hover:bg-white/10' }}">
        Diproses
    </button>

    <i class="fas fa-chevron-right text-white/20 text-xs"></i>

    {{-- Tombol Siap Diambil --}}
    <button type="submit" name="status" value="siap_diambil"
        class="px-3 py-2 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-1 transition-all
        {{ $order->status == 'siap_diambil' ? 'btn-flow-active' : 'bg-white/5 text-white/50 hover:bg-white/10' }}">
        Siap Diambil
    </button>

    <i class="fas fa-chevron-right text-white/20 text-xs"></i>

    {{-- Tombol Ambil & Bayar --}}
    <button type="submit" name="status" value="diambil_dibayar"
        class="px-3 py-2 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center gap-1 transition-all
        {{ $order->status == 'diambil_dibayar' ? 'btn-flow-active' : 'bg-white/5 text-white/50 hover:bg-white/10' }}">
        Ambil & Bayar
    </button>

    <i class="fas fa-chevron-right text-white/20 text-xs"></i>

    {{-- Tombol Invoice --}}
<a href="{{ route('orders.invoice', $order->id) }}" 
   target="_blank"
   class="px-3 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider flex items-center gap-1 bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500/20 transition-all">
    <i class="fas fa-print"></i> Invoice
</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>