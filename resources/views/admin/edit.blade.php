<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - SitamDeals</title>
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

        .btn-gold {
            background-color: #e8c96a;
            color: #0e2118;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            background-color: #c9a84c;
        }

        .btn-batal {
            border: 1px solid rgba(255, 255, 255, 0.2);
            background-color: rgba(255, 255, 255, 0.02);
            color: #ffffff;
            border-radius: 12px;
        }

        /* Mematikan spinner naik-turun bawaan browser pada input nomor agar tidak merusak layout */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="font-sans min-h-screen py-10 px-4 md:px-8 flex justify-center items-center">

    <div class="w-full max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="/admin/dashboard" class="text-white text-xs font-bold uppercase tracking-wider flex items-center gap-2 hover:opacity-80">
                <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Katalog Utama
            </a>
        </div>

        <div class="glass-panel p-8 rounded-lg shadow-2xl">
            
            <div class="mb-8 border-b border-white/10 pb-6">
                <div class="inline-block border border-white/40 px-3 py-1 rounded-full">
                    <span class="text-[10px] text-white font-mono font-bold tracking-wider">
                        ID ITEM: #PROD-{{ $product->product_id }}
                    </span>
                </div>
                <h2 class="text-4xl font-playfair font-bold text-white mt-4">Edit Detail Produk</h2>
                <p class="text-sm text-white/80 mt-1">Perbarui informasi nama, harga, atau stok penempatan gudang ritel Tambah Jaya.</p>
            </div>

            <form method="POST" action="/admin/products/{{ $product->product_id }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Nama Produk</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white mr-3 flex items-center justify-center"><i class="fas fa-box"></i></span>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                               class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Harga Jual (RP)</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white font-sans text-sm font-bold mr-3 select-none">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                               class="w-full bg-transparent text-base font-sans text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    
                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang A</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_A" value="{{ old('stock_A', $product->stock_A) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">A</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang B</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_B" value="{{ old('stock_B', $product->stock_B) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">B</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang C</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_C" value="{{ old('stock_C', $product->stock_C) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">C</span>
                        </div>
                    </div>

                </div>

                <div class="pt-6 border-t border-white/10 flex items-center gap-4">
                    <a href="/admin/dashboard" class="btn-batal px-6 py-3.5 text-xs font-bold tracking-wider uppercase text-center transition-all">
                        Batal
                    </a>
                    <button type="submit" class="btn-gold px-8 py-3.5 text-xs flex items-center gap-2 uppercase tracking-wider shadow-md">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>