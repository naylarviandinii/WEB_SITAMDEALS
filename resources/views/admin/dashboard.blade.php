<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SitamDeals</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400;1,600;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&display=swap');

        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }

        body {
            background-color: #0A1A12;
            color: #ffffff;
        }

        /* Glassmorphism Effect untuk Card dan Tabel */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Tombol Gradasi Emas Tambah Jaya */
        .btn-gold {
            background: linear-gradient(90deg, #c9a84c, #e8c96a, #c9a84c);
            background-size: 200% auto;
            color: #0e2118;
            transition: all 0.4s ease;
        }
        .btn-gold:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(201, 168, 76, 0.3);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease forwards; }
    </style>
</head>
<body class="font-sans min-h-screen relative overflow-x-hidden pb-12">

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#1a4a2e] rounded-full filter blur-[120px] opacity-40 pointer-events-none"></div>
    <div class="absolute bottom-[10%] right-[-5%] w-[40%] h-[50%] bg-[#c9a84c] rounded-full filter blur-[160px] opacity-10 pointer-events-none"></div>

    <nav class="glass-card sticky top-0 z-50 px-6 py-4 flex justify-between items-center border-b border-white/10 shadow-lg">
        <div class="flex items-center gap-3">
            <span class="text-2xl font-playfair font-black text-white tracking-wide">
                Sitam<span class="text-[#c9a84c]">Deals</span>
            </span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/[0.04] border border-[#c9a84c]/50 text-[#c9a84c] text-[10px] font-bold tracking-[1.5px] uppercase font-sans">
                ✦ Owner Admin
            </span>
        </div>
        <form action="/logout" method="POST" class="m-0">
            @csrf
            <button type="submit" class="text-sm font-semibold text-white/70 hover:text-rose-400 transition-all flex items-center gap-2 group">
                <i class="fas fa-sign-out-alt text-xs group-hover:translate-x-1 transition-transform"></i> Keluar
            </button>
        </form>
    </nav>

    <main class="max-w-7xl mx-auto p-6 mt-8 relative z-10 animate-fade-up">
        
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-playfair font-bold text-white tracking-tight flex items-center gap-3">
                    Manajemen Katalog Produk
                </h1>
                <p class="text-white/60 text-xs mt-1 font-sans">Pantau sebaran persediaan dan kelola item toko Tambah Jaya Anda.</p>
            </div>
            <a href="/admin/products/create" class="btn-gold font-bold text-xs px-5 py-3.5 rounded-xl shadow-md inline-flex items-center gap-2 self-start sm:self-auto uppercase tracking-wider font-sans">
                <i class="fas fa-plus-circle text-sm"></i> Tambah Produk Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 p-4 rounded-xl mb-6 shadow-md text-sm flex items-center gap-3 backdrop-blur-md">
                <i class="fas fa-check-circle text-emerald-400 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($limitProducts->count() > 0)
        <div class="bg-rose-950/30 border border-rose-500/30 rounded-2xl p-5 mb-8 backdrop-blur-md shadow-lg">
            <div class="flex items-center gap-2.5 text-rose-300 mb-4">
                <span class="text-xl drop-shadow-[0_0_8px_rgba(244,63,94,0.5)]"><i class="fas fa-exclamation-triangle"></i></span>
                <span class="text-base font-playfair font-bold tracking-wide text-white">Peringatan Restock Produk!</span>
                <span class="text-[10px] bg-rose-500/20 text-rose-300 px-2.5 py-0.5 rounded-full border border-rose-500/40 font-bold tracking-wide ml-1">
                    {{ $limitProducts->count() }} Item Menipis
                </span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($limitProducts as $lp)
                <div class="bg-white/[0.02] border border-white/5 p-4 rounded-xl flex justify-between items-center hover:border-rose-500/20 transition-colors">
                    <div>
                        <p class="font-semibold text-white/90 text-sm font-sans tracking-wide">{{ $lp->name }}</p>
                        <p class="text-xs text-white/50 mt-0.5 font-mono">Rp {{ number_format($lp->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-1 font-mono text-[10px] text-white/60">
                        <span class="bg-rose-500/20 border border-rose-500/50 text-rose-300 font-bold px-2.5 py-1 rounded-md text-xs">
                            A: {{ $lp->stock_A }} | B: {{ $lp->stock_B }} | C: {{ $lp->stock_C }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="glass-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse font-sans">
                    <thead>
                        <tr class="bg-white/[0.02] border-b border-white/10 text-[#c9a84c] text-xs font-bold uppercase tracking-[1.5px]">
                            <th class="p-5">Nama Produk</th>
                            <th class="p-5">Harga Jual</th>
                            <th class="p-5 text-center">Stok Gudang A</th>
                            <th class="p-5 text-center">Stok Gudang B</th>
                            <th class="p-5 text-center">Stok Gudang C</th>
                            <th class="p-5 text-center">Opsi Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="text-white/80 text-sm divide-y divide-white/[0.04]">
                        @forelse($allProducts as $product)
                        <tr class="hover:bg-white/[0.02] transition-colors duration-200">
                            <td class="p-5">
                                <div class="font-semibold text-white tracking-wide text-[15px]">{{ $product->name }}</div>
                                <span class="text-[10px] text-white/40 font-mono block mt-0.5">ID: #PROD-{{ $product->product_id }}</span>
                            </td>
                            
                            <td class="p-5 font-medium text-white/90 font-mono">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            
                            <td class="p-5 text-center font-mono">
                                <span class="px-3 py-1 rounded-md text-xs {{ $product->stock_A <= 10 ? 'bg-rose-500/10 border border-rose-500/40 text-rose-400 font-bold' : 'bg-white/[0.03] text-white/70' }}">
                                    {{ $product->stock_A }} pcs
                                </span>
                            </td>
                            
                            <td class="p-5 text-center font-mono">
                                <span class="px-3 py-1 rounded-md text-xs {{ $product->stock_B <= 10 ? 'bg-rose-500/10 border border-rose-500/40 text-rose-400 font-bold' : 'bg-white/[0.03] text-white/70' }}">
                                    {{ $product->stock_B }} pcs
                                </span>
                            </td>
                            
                            <td class="p-5 text-center font-mono">
                                <span class="px-3 py-1 rounded-md text-xs {{ $product->stock_C <= 10 ? 'bg-rose-500/10 border border-rose-500/40 text-rose-400 font-bold' : 'bg-white/[0.03] text-white/70' }}">
                                    {{ $product->stock_C }} pcs
                                </span>
                            </td>
                            
                            <td class="p-5 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="/admin/products/{{ $product->product_id }}/edit" 
                                       class="border border-white/10 hover:border-[#c9a84c] hover:text-[#c9a84c] bg-white/[0.02] text-white/70 font-semibold px-3 py-2 rounded-xl text-xs transition flex items-center gap-1.5 shadow-sm">
                                        <i class="fas fa-edit text-[10px]"></i> Edit
                                    </a>
                                    
                                    <form action="/admin/products/{{ $product->product_id }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-rose-500/10 border border-rose-500/20 text-rose-400 hover:bg-rose-600 hover:text-white font-semibold px-3 py-2 rounded-xl text-xs transition flex items-center gap-1.5 shadow-sm">
                                            <i class="fas fa-trash-alt text-[10px]"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-white/40 font-sans tracking-wide">
                                <div class="text-2xl mb-2 text-[#c9a84c]/40"><i class="fas fa-box-open"></i></div>
                                Belum ada produk terdaftar di database. Silahkan tambah produk baru!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>