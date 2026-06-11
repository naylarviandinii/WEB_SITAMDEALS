<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru - SitamDeals</title>
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
        .btn-batal:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }

        /* Mematikan spinner naik-turun bawaan browser pada input nomor */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] {
            -moz-appearance: textfield;
        }

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            color: #ffffff !important;
        }

        select option {
            background-color: #0a1a12 !important;
            color: #ffffff !important;
        }
        
        select option:disabled {
            color: rgba(255, 255, 255, 0.3) !important;
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
                        FORM BARANG BARU
                    </span>
                </div>
                <h2 class="text-4xl font-playfair font-bold text-white mt-4">Tambah Produk Baru</h2>
                <p class="text-sm text-white/80 mt-2">Masukkan data spesifikasi nama, harga jual, beserta alokasi awal stok gudang Tambah Jaya.</p>
            </div>

            @if($errors->any())
            <div class="mb-6 bg-red-950/50 border border-red-500/30 rounded-xl p-4">
                <ul class="text-red-400 text-xs space-y-1">
                    @foreach($errors->all() as $e)
                    <li><i class="fas fa-exclamation-circle mr-1"></i> {{ $e }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="/admin/products" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Nama Produk</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white mr-3 flex items-center justify-center"><i class="fas fa-box"></i></span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama produk..." required
                               class="w-full bg-transparent text-base text-white p-2 m-0 border-none outline-none focus:ring-0 focus:outline-none placeholder-white/30">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Kategori</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white mr-3 flex items-center justify-center"><i class="fas fa-tags"></i></span>
                        <select name="category" required class="w-full bg-transparent text-base text-white p-2 m-0 border-none outline-none focus:ring-0 focus:outline-none cursor-pointer">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori produk...</option>
                            <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Kebutuhan Pokok" {{ old('category') == 'Kebutuhan Pokok' ? 'selected' : '' }}>Kebutuhan Pokok</option>
                            <option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Bumbu Dapur" {{ old('category') == 'Bumbu Dapur' ? 'selected' : '' }}>Bumbu Dapur</option>
                            <option value="Kebutuhan Bayi" {{ old('category') == 'Kebutuhan Bayi' ? 'selected' : '' }}>Kebutuhan Bayi</option>
                            <option value="Perawatan Tubuh" {{ old('category') == 'Perawatan Tubuh' ? 'selected' : '' }}>Perawatan Tubuh</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Harga Jual (RP)</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white font-sans text-sm font-bold mr-3 select-none">Rp</span>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="0" required min="0"
                               class="w-full bg-transparent text-base font-sans text-white p-1 m-0 border-none outline-none focus:ring-0 focus:outline-none placeholder-white/30">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Deskripsi Produk</label>
                    <div class="flex items-start w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white mr-3 mt-2 flex items-center justify-center"><i class="fas fa-align-left"></i></span>
                        <textarea name="description" placeholder="Masukkan deskripsi atau spesifikasi detail produk..." rows="3"
                                  class="w-full bg-transparent text-base text-white p-2 m-0 border-none outline-none focus:ring-0 focus:outline-none placeholder-white/30 resize-none">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Gambar Produk</label>
                    <div class="flex items-center w-full bg-[#0A1A12] border border-white/40 rounded-xl px-4 py-3.5 focus-within:border-white transition-all">
                        <span class="text-white mr-3 flex items-center justify-center"><i class="fas fa-image"></i></span>
                        <input type="file" name="image" accept="image/*" required
                               class="w-full bg-transparent text-base text-white p-2 m-0 border-none outline-none focus:ring-0 focus:outline-none file:mr-4 file:py-1 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-white/10 file:text-white hover:file:bg-white/20">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                    
                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang Grade A</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_A" value="{{ old('stock_A', 0) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">A</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang Grade B</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_B" value="{{ old('stock_B', 0) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">B</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold tracking-wider uppercase text-white mb-2">Stok Gudang Grade C</label>
                        <div class="flex items-center w-full bg-[#0A1A12] border border-white/20 rounded-xl px-4 py-3 focus-within:border-white transition-all">
                            <input type="number" name="stock_C" value="{{ old('stock_C', 0) }}" required min="0"
                                   class="w-full bg-transparent text-base text-white p-0 m-0 border-none outline-none focus:ring-0 focus:outline-none">
                            <span class="text-white/50 text-sm font-sans ml-2 select-none">C</span>
                        </div>
                    </div>

                    <a href="/admin/dashboard" class="btn-batal px-6 py-3.5 text-xs font-bold tracking-wider uppercase text-center transition-all flex items-center justify-center">
                        Batal
                    </a>
                    <button type="submit" class="btn-gold px-8 py-3.5 text-xs flex items-center justify-center gap-2 uppercase tracking-wider shadow-md">
                        <i class="fas fa-plus text-[10px]"></i> Tambah Produk
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>