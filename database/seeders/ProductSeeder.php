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
        $products = [
            [
                'name' => 'Air Mineral',
                'description' => 'Air mineral kemasan botol segar.',
                'price' => 5000,
                'category' => 'Minuman',
                'stock_A' => 50, 'stock_B' => 30, 'stock_C' => 20,
                'image' => 'air-mineral.jpg',
            ],
            [
                'name' => 'Aqua',
                'description' => 'Air minum dalam kemasan Aqua.',
                'price' => 5500,
                'category' => 'Minuman',
                'stock_A' => 100, 'stock_B' => 80, 'stock_C' => 50,
                'image' => 'aqua.jpg',
            ],
            [
                'name' => 'Beras Sumo',
                'description' => 'Beras premium Sumo kemasan pack.',
                'price' => 75000,
                'category' => 'Kebutuhan Pokok',
                'stock_A' => 20, 'stock_B' => 15, 'stock_C' => 10,
                'image' => 'beras.jpg',
            ],
            [
                'name' => 'Biskuit Roma Kelapa',
                'description' => 'Biskuit Roma rasa kelapa yang renyah.',
                'price' => 10000,
                'category' => 'Makanan Ringan',
                'stock_A' => 40, 'stock_B' => 25, 'stock_C' => 15,
                'image' => 'biscuit-roma.jpg',
            ],
            [
                'name' => 'Indomie Goreng',
                'description' => 'Mie instan goreng favorit keluarga.',
                'price' => 3500,
                'category' => 'Makanan',
                'stock_A' => 200, 'stock_B' => 150, 'stock_C' => 100,
                'image' => 'indomie-goreng.jpg',
            ],
            [
                'name' => 'Kecap ABC',
                'description' => 'Kecap manis ABC kemasan isi ulang.',
                'price' => 15000,
                'category' => 'Bumbu Dapur',
                'stock_A' => 35, 'stock_B' => 20, 'stock_C' => 15,
                'image' => 'kecap.jpg',
            ],
            [
                'name' => 'Sabun Lifebuoy',
                'description' => 'Sabun mandi batang Lifebuoy pelindung kuman.',
                'price' => 4500,
                'category' => 'Perawatan Tubuh',
                'stock_A' => 60, 'stock_B' => 40, 'stock_C' => 30,
                'image' => 'lifebuoy.jpg',
            ],
            [
                'name' => 'Minyak Goreng SunCo',
                'description' => 'Minyak goreng baik dan higienis SunCo.',
                'price' => 38000,
                'category' => 'Kebutuhan Pokok',
                'stock_A' => 30, 'stock_B' => 25, 'stock_C' => 20,
                'image' => 'minyak-goreng.jpg',
            ],
            [
                'name' => 'Minyak Telon My Baby (Kecil)',
                'description' => 'Minyak telon bayi My Baby perlindungan 12 jam.',
                'price' => 22000,
                'category' => 'Kebutuhan Bayi',
                'stock_A' => 25, 'stock_B' => 15, 'stock_C' => 10,
                'image' => 'minyak-telon.jpg', // Berdasarkan urutan gambar pertama
            ],
            [
                'name' => 'Minyak Telon My Baby (Besar)',
                'description' => 'Minyak telon bayi My Baby ukuran besar.',
                'price' => 40000,
                'category' => 'Kebutuhan Bayi',
                'stock_A' => 20, 'stock_B' => 15, 'stock_C' => 10,
                'image' => 'minyak-telon.jpg', // Berdasarkan urutan gambar kedua
            ],
            [
                'name' => 'Pampers',
                'description' => 'Popok bayi sekali pakai Pampers ukuran M.',
                'price' => 85000,
                'category' => 'Kebutuhan Bayi',
                'stock_A' => 15, 'stock_B' => 12, 'stock_C' => 8,
                'image' => 'pampers.jpg',
            ],
            [
                'name' => 'Rinso Cair Rose Fresh',
                'description' => 'Deterjen cair Rinso + Molto Rose Fresh.',
                'price' => 18000,
                'category' => 'Kebutuhan Rumah Tangga',
                'stock_A' => 45, 'stock_B' => 30, 'stock_C' => 20,
                'image' => 'rinso.jpg',
            ],
            [
                'name' => 'Rinso Bubuk',
                'description' => 'Deterjen bubuk Rinso Antinoda.',
                'price' => 12000,
                'category' => 'Kebutuhan Rumah Tangga',
                'stock_A' => 50, 'stock_B' => 35, 'stock_C' => 25,
                'image' => 'rinsoo.jpg', // Sesuai typo nama file di foto Anda
            ],
            [
                'name' => 'Shampo Sunsilk',
                'description' => 'Shampo Sunsilk kuning untuk rambut lembut.',
                'price' => 24000,
                'category' => 'Perawatan Tubuh',
                'stock_A' => 40, 'stock_B' => 30, 'stock_C' => 20,
                'image' => 'shampo.jpg',
            ],
            [
                'name' => 'Susu Kental Manis Frisian Flag',
                'description' => 'Susu kental manis (SKM) Frisian Flag kaleng.',
                'price' => 13500,
                'category' => 'Minuman',
                'stock_A' => 55, 'stock_B' => 40, 'stock_C' => 30,
                'image' => 'skm.jpg',
            ],
            [
                'name' => 'So Klin Lantai',
                'description' => 'Cairan pembersih lantai So Klin aromatik.',
                'price' => 11000,
                'category' => 'Kebutuhan Rumah Tangga',
                'stock_A' => 40, 'stock_B' => 25, 'stock_C' => 20,
                'image' => 'soklin-lantai.jpg',
            ],
            [
                'name' => 'Susu UHT Ultra Milk',
                'description' => 'Susu segar UHT Ultra Milk Rasa Full Cream.',
                'price' => 19500,
                'category' => 'Minuman',
                'stock_A' => 60, 'stock_B' => 45, 'stock_C' => 35,
                'image' => 'susu-uht.jpg',
            ],
            [
                'name' => 'Tepung Terigu Segitiga Biru',
                'description' => 'Tepung terigu serbaguna Segitiga Biru.',
                'price' => 14000,
                'category' => 'Bumbu Dapur',
                'stock_A' => 50, 'stock_B' => 35, 'stock_C' => 25,
                'image' => 'tepung-terigu.jpg',
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