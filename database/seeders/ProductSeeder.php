<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$this->call([
          //  ProductSeeder::class,
        //]);
        
        $products = [
            [
                'product_id' => 1,
                'name' => 'Minyak Goreng 2L',
                'description' => "Minyak goreng sawit murni 2 liter untuk memasak sehari-hari. \r\nGrade A (Rp 27.000): Kemasan botol plastik bolong kecil di tutup, tidak bocor, isi produk aman. \r\nGrade B (Rp 22.000): Kardus kemasan penyok samping, expired 5 bulan lagi. \r\nGrade C (Rp 16.000): Plastik kemasan robek besar sudah di-repack, expired 1 bulan lagi",
                'price' => 27000,
                'category' => 'Bumbu & Rempah',
                'stock_A' => 4, 'stock_B' => 4, 'stock_C' => 0,
                'image' => 'minyak-goreng.jpg',
            ],
            [
                'product_id' => 2,
                'name' => 'Susu UHT 1L',
                'description' => "Susu UHT full cream 1 liter, kaya nutrisi dan tahan lama tanpa pengawet. \r\nGrade A (Rp 9.000): Botol ada goresan kecil di label, barang sisa event Lebaran 2025. \r\nGrade B (Rp 7.000): Kardus kemasan penyok samping, expired 5 bulan lagi. \r\nGrade C (Rp 5.000): Kardus penyok parah, expired 1.5 bulan lagi",
                'price' => 9000,
                'category' => 'Susu & Olahan',
                'stock_A' => 8, 'stock_B' => 1, 'stock_C' => 4,
                'image' => 'susu-uht.jpg',
            ],
            [
                'product_id' => 3,
                'name' => 'Beras 5Kg',
                'description' => "Beras putih premium kualitas terbaik, pulen dan wangi, kemasan 5 kg. \r\nGrade A (Rp 64.000): Plastik kemasan bolong titik-titik kecil sudah direkatkan. \r\nGrade B (Rp 53.000): Plastik kemasan robek sedang sudah ditambal, expired 4 bulan lagi. \r\nGrade C (Rp 38.000): Plastik kemasan robek besar sudah di-repack, expired 1 bulan lagi",
                'price' => 64000,
                'category' => 'Bumbu & Rempah',
                'stock_A' => 10, 'stock_B' => 6, 'stock_C' => 2,
                'image' => 'beras.jpg',
            ],
            [
                'product_id' => 4,
                'name' => 'Kecap Manis 600ml',
                'description' => "Kecap manis asli khas Indonesia untuk bumbu masakan. \r\nGrade A (Rp 13.000): Botol kaca ada goresan kecil di label. \r\nGrade B (Rp 11.000): Botol penyok tutup, expired 6 bulan lagi. \r\nGrade C (Rp 8.000): Botol penyok parah di badan, expired 1.5 bulan lagi",
                'price' => 13000,
                'category' => 'Bumbu & Rempah',
                'stock_A' => 15, 'stock_B' => 7, 'stock_C' => 3,
                'image' => 'kecap.jpg',
            ],
            [
                'product_id' => 5,
                'name' => 'Tepung Terigu 1Kg',
                'description' => "Tepung terigu serbaguna kualitas premium. \r\nGrade A (Rp 12.000): Plastik kemasan bolong kecil. \r\nGrade B (Rp 10.000): Plastik kemasan bolong sedang. \r\nGrade C (Rp 7.000): Plastik robek besar sudah di-repack",
                'price' => 12000,
                'category' => 'Bumbu & Rempah',
                'stock_A' => 20, 'stock_B' => 10, 'stock_C' => 5,
                'image' => 'tepung-terigu.jpg',
            ],
            [
                'product_id' => 6,
                'name' => 'Indomie Goreng',
                'description' => "Mie instan goreng favorit. \r\nGrade A: Kemasan rapi. \r\nGrade B: Kemasan sedikit penyok. \r\nGrade C: Kemasan sobek luar",
                'price' => 3500,
                'category' => 'Camilan & Minuman',
                'stock_A' => 30, 'stock_B' => 20, 'stock_C' => 10,
                'image' => 'indomie-goreng.png',
            ],
            [
                'product_id' => 7,
                'name' => 'Air Mineral 1.5L',
                'description' => "Air mineral segar. \nGrade A: Botol mulus. \nGrade B: Label lecet. \nGrade C: Botol penyok ringan",
                'price' => 5000,
                'category' => 'Camilan & Minuman',
                'stock_A' => 25, 'stock_B' => 15, 'stock_C' => 8,
                'image' => 'air-mineral.jpg',
            ],
            [
                'product_id' => 8,
                'name' => 'Sabun Lifebuoy',
                'description' => "Sabun antibakteri. \r\nGrade A: Kemasan bagus. \r\nGrade B: Box penyok. \r\nGrade C: Kemasan terbuka",
                'price' => 4000,
                'category' => 'Perawatan Diri',
                'stock_A' => 18, 'stock_B' => 10, 'stock_C' => 5,
                'image' => 'lifebuoy.jpg',
            ],
            [
                'product_id' => 9,
                'name' => 'Shampoo Sunsilk',
                'description' => "Shampoo rambut halus. \r\nGrade A: Botol mulus. \r\nGrade B: Tutup lecet. \r\nGrade C: Label rusak",
                'price' => 15000,
                'category' => 'Perawatan Diri',
                'stock_A' => 11, 'stock_B' => 8, 'stock_C' => 4,
                'image' => 'shampo.jpg',
            ],
            [
                'product_id' => 10,
                'name' => 'Detergen Rinso Cair 700ml',
                'description' => "Deterjen pembersih noda. \r\nGrade A: Kemasan utuh. \r\nGrade B: Plastik penyok. \r\nGrade C: Plastik robek kecil",
                'price' => 18000,
                'category' => 'Kebersihan Rumah',
                'stock_A' => 14, 'stock_B' => 9, 'stock_C' => 5,
                'image' => 'rinsoo.jpg',
            ],
            [
                'product_id' => 11,
                'name' => 'Pembersih Lantai',
                'description' => "Cairan pel lantai. \r\nGrade A: Botol bagus. \r\nGrade B: Tutup lecet. \r\nGrade C: Botol penyok",
                'price' => 12000,
                'category' => 'Kebersihan Rumah',
                'stock_A' => 10, 'stock_B' => 6, 'stock_C' => 3,
                'image' => 'soklin-lantai.jpg',
            ],
            [
                'product_id' => 12,
                'name' => 'Biskuit Roma',
                'description' => "Biskuit renyah. \r\nGrade A: Box utuh. \r\nGrade B: Box penyok. \r\nGrade C: Kemasan terbuka",
                'price' => 8000,
                'category' => 'Camilan & Minuman',
                'stock_A' => 22, 'stock_B' => 9, 'stock_C' => 6,
                'image' => 'biskuit-roma.jpg',
            ],
            [
                'product_id' => 13,
                'name' => 'Susu Kental Manis',
                'description' => "Susu topping. \r\nGrade A: Kaleng mulus. \r\nGrade B: Kaleng penyok. \r\nGrade C: Label rusak",
                'price' => 11000,
                'category' => 'Susu & Olahan',
                'stock_A' => 16, 'stock_B' => 9, 'stock_C' => 4,
                'image' => 'skm.png',
            ],
            [
                'product_id' => 14,
                'name' => 'Popok Bayi',
                'description' => "Popok nyaman. \r\nGrade A: Kemasan baru. \r\nGrade B: Kemasan penyok. \r\nGrade C: Kemasan robek",
                'price' => 45000,
                'category' => 'Kebutuhan Bayi',
                'stock_A' => 10, 'stock_B' => 5, 'stock_C' => 2,
                'image' => 'pampers.jpg',
            ],
            [
                'product_id' => 15,
                'name' => 'Minyak Telon',
                'description' => "Minyak bayi. \r\nGrade A: Botol bagus. \r\nGrade B: Label rusak. \r\nGrade C: Tutup lecet",
                'price' => 20000,
                'category' => 'Kebutuhan Bayi',
                'stock_A' => 8, 'stock_B' => 4, 'stock_C' => 2,
                'image' => 'minyak-telon.png',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}