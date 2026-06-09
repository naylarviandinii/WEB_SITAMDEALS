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
        body { background-color: #050d09; color: #ffffff; font-family: 'Inter', sans-serif; }
        .glass-panel { background-color: #0A1A12; border: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-flow-active { background-color: #e8c96a; color: #0e2118; border: 1px solid #e8c96a; font-weight: 700; }
    </style>
</head>
<body class="py-10 px-4 md:px-8">
    <div class="w-full max-w-7xl mx-auto">
        <div class="mb-8 border-b border-white/10 pb-6">
            <h2 class="text-4xl font-playfair font-bold">Manajemen Status Pemesanan</h2>
        </div>
        
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
                                {{-- Loop untuk tombol status dengan form terpisah --}}
                                @foreach(['diterima' => 'Diterima', 'diproses' => 'Diproses', 'diambil_dibayar' => 'Siap Diambil dan Bayar'] as $key => $label)
                                    <form method="POST" action="/admin/orders/{{ $order->id }}/update-status">
                                        @csrf @method('PATCH')
                                        <button type="submit" name="status" value="{{ $key }}"
                                            class="px-3 py-2 rounded-xl text-[10px] font-bold uppercase transition-all {{ $order->status == $key ? 'btn-flow-active' : 'bg-white/5 text-white/40 hover:bg-white/10' }}">
                                            {{ $label }}
                                        </button>
                                    </form>
                                    @if(!$loop->last) <i class="fas fa-chevron-right text-white/10 text-[10px]"></i> @endif
                                @endforeach

                                {{-- Tombol Invoice --}}
                                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
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