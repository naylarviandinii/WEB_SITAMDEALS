@extends('layouts.app')
@section('title', 'Katalog Produk – SiTamDeals')

@section('content')

{{-- ===================================================
     HEADER
===================================================  --}}
<header class="bg-forest pt-12 pb-14 px-[6%] text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"
         style="background-image: radial-gradient(circle at 70% 50%, #c9a84c 0%, transparent 60%);">
    </div>
    <div class="relative z-10">
        <div class="text-[10px] font-bold tracking-[3px] uppercase text-sage mb-3">Tambah Jaya</div>
        <h1 class="font-playfair text-4xl md:text-5xl font-black text-cream mb-3">Katalog Lengkap</h1>
        <p class="text-mint/60 text-sm tracking-widest uppercase font-semibold">Cari kebutuhanmu di sini</p>
    </div>
</header>

{{-- ===================================================
     SEARCH BAR
===================================================  --}}
<section class="py-10 px-[6%] bg-[#f0f4ee] border-b border-gray-200">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row gap-4 items-center justify-between">

        {{-- Form Cari --}}
        <form action="{{ route('products') }}" method="GET" class="flex w-full sm:w-auto sm:flex-1 max-w-lg shadow-lg rounded-2xl overflow-hidden">
            <input type="text" name="search"
                   placeholder="Cari minyak, beras, susu..."
                   value="{{ $search ?? '' }}"
                   class="flex-1 px-6 py-4 bg-white text-sm outline-none text-forest placeholder-gray-400">
            <button type="submit" class="bg-gold text-forest px-7 font-black hover:bg-yellow-400 transition text-lg">
                🔍
            </button>
        </form>

        {{-- Info hasil --}}
        @if(!empty($search))
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <span>Hasil untuk:</span>
            <span class="font-bold text-forest bg-white border border-gray-200 px-3 py-1 rounded-full">
                "{{ $search }}"
            </span>
            <a href="{{ route('products') }}" class="text-red-400 hover:text-red-600 ml-1" title="Reset">
                <i class="fas fa-times-circle"></i>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ===================================================
     GRID PRODUK
===================================================  --}}
<section class="py-14 px-[6%] bg-[#f0f4ee]">
    <div class="max-w-6xl mx-auto">

        @if($products->isNotEmpty())

        {{-- Jumlah produk --}}
        <p class="text-sm text-gray-400 mb-8">
            Menampilkan <span class="font-bold text-forest">{{ $products->count() }}</span> produk
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $row)
            <div class="group bg-white rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col">

                {{-- Gambar --}}
                <div class="h-48 overflow-hidden bg-gray-50 relative">
                    @if($row->image && file_exists(public_path('img/'.$row->image)))
                        <img src="{{ asset('img/'.$row->image) }}"
                             alt="{{ $row->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                            <span class="text-5xl">🛒</span>
                            <span class="text-[10px] mt-2 italic">Gambar Belum Tersedia</span>
                        </div>
                    @endif

                    {{-- Badge kategori --}}
                    <div class="absolute top-3 left-3 bg-gold/90 backdrop-blur text-forest text-[9px] font-black px-2.5 py-1 rounded-lg uppercase shadow-sm">
                        {{ $row->category ?? 'Produk' }}
                    </div>

                    {{-- Badge stok --}}
                    @php $totalStok = $row->stock_A + $row->stock_B + $row->stock_C; @endphp
                    @if($totalStok == 0)
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                        <span class="text-white text-xs font-black bg-red-600 px-3 py-1 rounded-full uppercase">Habis</span>
                    </div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="p-5 flex flex-col flex-grow">
                    <span class="text-[9px] font-bold text-sage/60 uppercase tracking-[2px] mb-1.5">Tambah Jaya</span>
                    <h3 class="font-bold text-forest text-sm mb-2 group-hover:text-gold transition-colors line-clamp-2 leading-snug flex-grow">
                        {{ $row->name }}
                    </h3>

                    <div class="font-playfair text-xl font-black text-sage mt-1">
                        Rp {{ number_format($row->price, 0, ',', '.') }}
                    </div>

                    {{-- Stok badge per grade --}}
                    <div class="flex gap-1.5 mt-3">
                        @foreach(['A','B','C'] as $g)
                        @php $stokG = $row->{'stock_'.$g}; @endphp
                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-md {{ $stokG > 0 ? 'bg-sage/10 text-sage' : 'bg-gray-100 text-gray-300 line-through' }}">
                            {{ $g }}: {{ $stokG }}
                        </span>
                        @endforeach
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('products.detail', $row->product_id) }}"
                           class="text-[10px] font-bold text-forest/40 hover:text-gold transition uppercase tracking-widest">
                            Lihat Detail
                        </a>
                        @if($totalStok > 0)
                        <a href="{{ route('products.detail', $row->product_id) }}"
                           class="bg-forest text-white w-10 h-10 rounded-xl hover:bg-gold hover:text-forest transition-all flex items-center justify-center shadow-md font-bold text-sm">
                            +
                        </a>
                        @else
                        <span class="bg-gray-100 text-gray-300 w-10 h-10 rounded-xl flex items-center justify-center text-sm cursor-not-allowed">
                            +
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else

        {{-- Kosong --}}
        <div class="text-center py-32">
            <div class="text-7xl mb-6">🥡</div>
            <h3 class="font-playfair text-3xl font-bold text-forest mb-3">Produk Tidak Ditemukan</h3>
            <p class="text-gray-400 text-sm mb-8">
                @if(!empty($search))
                    Tidak ada produk dengan kata kunci <strong>"{{ $search }}"</strong>.
                @else
                    Belum ada produk tersedia saat ini.
                @endif
            </p>
            <a href="{{ route('products') }}"
               class="inline-flex items-center gap-2 bg-forest text-white px-8 py-3.5 rounded-2xl font-bold shadow-lg hover:bg-gold hover:text-forest transition">
                <i class="fas fa-redo"></i> Reset Katalog
            </a>
        </div>

        @endif

    </div>
</section>

@endsection