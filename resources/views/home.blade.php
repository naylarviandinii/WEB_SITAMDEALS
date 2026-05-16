@extends('layouts.app')
@section('title', 'SiTamDeals – Beranda')

@push('styles')
<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up   { animation: fadeUp   0.8s ease both; }
    .animate-fade-up-1 { animation: fadeUp   0.8s ease 0.15s both; }
    .animate-fade-up-2 { animation: fadeUp   0.8s ease 0.30s both; }
    .animate-fade-up-3 { animation: fadeUp   0.8s ease 0.45s both; }
    .animate-fade-down { animation: fadeDown 0.5s ease both; }
</style>
@endpush

@section('content')

{{-- ===================================================
     HERO SECTION
===================================================  --}}
<section class="relative min-h-screen flex items-center px-[6%] pt-10 overflow-hidden"
    style="background: linear-gradient(135deg,rgba(18,38,28,.90) 0%,rgba(46,92,66,.75) 60%,rgba(114,184,138,.35) 100%),
           url('https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=1600&q=80') center/cover no-repeat;">

    <div class="relative z-10 max-w-2xl animate-fade-up">
        <div class="inline-flex items-center gap-2 bg-[#D4AF37]/15 border border-[#D4AF37]/40 text-[#FFF8DC] text-[10px] font-bold tracking-[2px] uppercase px-4 py-1.5 rounded-full mb-6">
            ✦ Swalayan Tambah Jaya
        </div>

        <h1 class="font-playfair text-5xl md:text-6xl lg:text-7xl font-black text-[#FFF8DC] leading-[1.08] mb-6">
            Belanja Lebih<br>
            <em class="not-italic text-[#D4AF37]">Mudah,</em> Hidup<br>
            Lebih <em class="not-italic text-[#D4AF37]">Hemat</em>
        </h1>

        <p class="text-white/70 text-lg leading-relaxed max-w-lg mb-10 font-light animate-fade-up-1">
            Temukan ribuan produk berkualitas dengan harga transparan
            dan sistem grade yang jujur — langsung dari Swalayan Tambah Jaya.
        </p>

        <div class="flex flex-wrap gap-4 animate-fade-up-2">
            <a href="{{ route('products') }}"
               class="bg-[#D4AF37] text-forest font-black px-8 py-4 rounded-2xl shadow-lg hover:bg-[#FFF8DC] hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-store"></i> Lihat Produk
            </a>
            <a href="#cara-kerja"
               class="bg-[#D4AF37] border border-white/30 text-cream font-bold px-8 py-4 rounded-2xl hover:bg-white/10 transition-all duration-200 flex items-center gap-2">
                Cara Kerja <i class="fas fa-arrow-down"></i>
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-white/30 text-[10px] tracking-widest uppercase">Scroll</span>
        <i class="fas fa-chevron-down text-white/30 text-xs"></i>
    </div>
</section>

{{-- ===================================================
     STATS BAR
===================================================  --}}
<div class="bg-forest py-7 px-[6%] overflow-x-auto">
    <div class="flex min-w-[500px] lg:min-w-0 lg:max-w-4xl lg:mx-auto divide-x divide-white/10">
        @foreach ([['1000+','Produk'],['10K+','Pelanggan'],['5+','Tahun'],['4.9★','Rating']] as [$val,$label])
        <div class="flex-1 text-center px-4">
            <div class="font-playfair text-2xl md:text-3xl font-black text-gold mb-1">{{ $val }}</div>
            <div class="text-[10px] text-white/50 tracking-widest uppercase">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- ===================================================
     KATEGORI
===================================================  --}}
<section class="py-20 px-[6%] bg-cream">
    <div class="text-center mb-12">
        <div class="text-[10px] font-bold tracking-[3px] uppercase text-sage mb-3">Jelajahi Kategori</div>
        <h2 class="font-playfair text-4xl font-black text-forest">Semua Ada di Sini</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 max-w-5xl mx-auto">
        @foreach([
            ['🧴','Susu & Olahan'],
            ['🍜','Bumbu & Rempah'],
            ['🧴','Perawatan Diri'],
            ['🧹','Kebersihan'],
            ['🍪','Camilan'],
            ['👶','Kebutuhan Bayi'],
        ] as [$emoji, $nama])
        <a href="{{ route('products') }}"
           class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 group">
            <span class="text-3xl mb-3 block group-hover:scale-110 transition-transform duration-300">{{ $emoji }}</span>
            <div class="text-[10px] font-bold text-forest uppercase tracking-wide leading-tight">{{ $nama }}</div>
        </a>
        @endforeach
    </div>
</section>

{{-- ===================================================
     PRODUK TERLARIS
===================================================  --}}
<section class="py-20 px-[6%] bg-[#f0f4ee]">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12 max-w-5xl mx-auto">
        <div>
            <div class="text-[10px] tracking-[3px] uppercase text-sage mb-2">Pilihan Unggulan</div>
            <h2 class="font-playfair text-4xl font-black text-forest">Produk Terlaris</h2>
        </div>
        <a href="{{ route('products') }}"
           class="text-sage text-sm font-bold border-b border-sage pb-0.5 hover:text-forest hover:border-forest transition">
            Lihat Semua →
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
        @forelse($products as $row)
        <a href="{{ route('products.detail', $row->product_id) }}"
           class="group bg-white rounded-3xl overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 border border-gray-100">

            {{-- Gambar --}}
            <div class="h-56 relative overflow-hidden bg-gray-50">
                @if($row->image && file_exists(public_path('img/'.$row->image)))
                    <img src="{{ asset('img/'.$row->image) }}"
                         alt="{{ $row->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                        <span class="text-5xl">🛒</span>
                        <span class="text-[10px] mt-2 italic">No Image</span>
                    </div>
                @endif
                <span class="absolute top-3 left-3 bg-gold text-forest text-[10px] font-black px-2.5 py-1 rounded-full uppercase shadow-sm">
                    Produk
                </span>
            </div>

            {{-- Info --}}
            <div class="p-5 flex justify-between items-center">
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-forest text-sm truncate mb-1">{{ $row->name }}</div>
                    <div class="font-playfair text-xl font-bold text-sage">
                        Rp {{ number_format($row->price, 0, ',', '.') }}
                    </div>
                </div>
                <div class="w-10 h-10 bg-forest text-white rounded-full flex items-center justify-center text-lg font-bold hover:bg-gold hover:text-forest transition-colors shadow-md ml-3 flex-shrink-0">
                    +
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-3 text-center py-20 text-gray-400">
            <span class="text-5xl block mb-4">🏪</span>
            Belum ada produk tersedia.
        </div>
        @endforelse
    </div>
</section>

{{-- ===================================================
     CARA KERJA / SISTEM GRADE
===================================================  --}}
<section id="cara-kerja" class="py-20 px-[6%] bg-cream">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <div class="text-[10px] font-bold tracking-[3px] uppercase text-sage mb-3">Sistem Kami</div>
            <h2 class="font-playfair text-4xl font-black text-forest">Kenapa Ada Grade A, B, C?</h2>
            <p class="text-gray-500 text-sm mt-4 max-w-xl mx-auto leading-relaxed">
                Kami jujur soal kondisi produk. Daripada dibuang, produk yang kemasan luarnya sedikit tidak sempurna
                tetap aman dikonsumsi — dan bisa kamu beli dengan harga lebih hemat.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['A', 'Grade A', 'Lecet Halus', 'Diskon 15%', 'Kemasan sedikit lecet atau sisa event. Produk di dalam 100% aman.', 'bg-emerald-50 border-emerald-200 text-emerald-700'],
                ['B', 'Grade B', 'Penyok / Kardus Rusak', 'Diskon 30%', 'Kardus atau kemasan luar penyok. Isi produk tidak terpengaruh, expired masih > 4 bulan.', 'bg-amber-50 border-amber-200 text-amber-700'],
                ['C', 'Grade C', 'Repack / Dekat Expired', 'Diskon 50%', 'Kemasan sudah direpack atau expired tinggal 1–2 bulan. Cocok untuk segera dipakai.', 'bg-orange-50 border-orange-200 text-orange-700'],
            ] as [$huruf, $judul, $kondisi, $diskon, $desc, $color])
            <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-lg transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-forest text-gold font-playfair font-black text-xl rounded-2xl flex items-center justify-center shadow-md">
                        {{ $huruf }}
                    </div>
                    <div>
                        <div class="font-black text-forest text-base">{{ $judul }}</div>
                        <div class="text-xs text-gray-400">{{ $kondisi }}</div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ $desc }}</p>
                <span class="inline-flex items-center gap-1 text-[11px] font-black px-3 py-1 rounded-full border {{ $color }}">
                    🏷️ {{ $diskon }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================
     KEUNGGULAN
===================================================  --}}
<section class="py-20 px-[6%] bg-forest relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-5"
         style="background-image: radial-gradient(circle at 20% 50%, #c9a84c 0%, transparent 50%), radial-gradient(circle at 80% 50%, #4a8c64 0%, transparent 50%);">
    </div>

    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
        <div>
            <div class="text-[10px] tracking-[3px] uppercase text-leaf mb-4">Keunggulan Kami</div>
            <h2 class="font-playfair text-4xl font-black text-cream mb-8 leading-tight">
                Mengapa Memilih<br>Tambah Jaya?
            </h2>
            <div class="space-y-6">
                @foreach([
                    ['🏷️', 'Harga Transparan', 'Harga jujur sesuai kondisi barang, tanpa biaya tersembunyi apapun.'],
                    ['✅', 'Kualitas Terjamin', 'Setiap produk diseleksi ketat — grade C sekalipun tetap aman dikonsumsi.'],
                    ['📦', 'Keranjang Belanja', 'Tambahkan banyak produk sekaligus, checkout dalam satu klik.'],
                    ['📋', 'Riwayat Lengkap', 'Pantau semua transaksimu, kapanpun dan dimanapun.'],
                ] as [$icon, $judul, $desc])
                <div class="flex gap-4 items-start group">
                    <div class="w-11 h-11 min-w-[44px] bg-gold/10 border border-gold/20 rounded-xl flex items-center justify-center text-xl group-hover:bg-gold/20 transition">
                        {{ $icon }}
                    </div>
                    <div>
                        <h4 class="text-cream font-bold text-sm mb-1">{{ $judul }}</h4>
                        <p class="text-cream/50 text-xs leading-relaxed">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 bg-gold/5 border border-gold/15 rounded-2xl p-7 text-center hover:bg-gold/10 transition">
                <div class="text-4xl mb-3">🏪</div>
                <h3 class="font-playfair text-xl text-cream font-bold">Toko Terpercaya</h3>
                <p class="text-cream/40 text-xs mt-1">Melayani Surabaya sejak 2021</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center hover:bg-white/10 transition">
                <div class="text-3xl mb-2">🚚</div>
                <p class="text-cream text-xs font-bold uppercase tracking-wide">Pickup</p>
                <p class="text-cream/40 text-[10px] mt-1">Ambil langsung di toko</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center hover:bg-white/10 transition">
                <div class="text-3xl mb-2">💳</div>
                <p class="text-cream text-xs font-bold uppercase tracking-wide">QRIS / Cash</p>
                <p class="text-cream/40 text-[10px] mt-1">Bayar fleksibel</p>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
     CTA BOTTOM
===================================================  --}}
<section class="py-20 px-[6%] bg-cream text-center">
    <div class="max-w-xl mx-auto">
        <h2 class="font-playfair text-4xl font-black text-forest mb-4">Siap Belanja Sekarang?</h2>
        <p class="text-gray-500 text-sm mb-8">Jelajahi ratusan produk dengan harga terbaik, pilih grade sesuai budget kamu.</p>
        <a href="{{ route('products') }}"
           class="inline-flex items-center gap-3 bg-forest text-cream font-black px-10 py-5 rounded-2xl shadow-xl hover:bg-gold hover:text-forest transition-all duration-300 text-base">
            <i class="fas fa-store"></i> Mulai Belanja
        </a>
    </div>
</section>

@endsection