<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Kayu Manis Kerinci Premium',
            'harga' => 85000,
            'kategori' => 'Rempah',
            'deskripsi' => 'Kayu manis pilihan langsung dari perkebunan Kerinci, aroma kuat dan cita rasa tinggi.',
            'berat' => '250 gram',
            'stok' => 'Tersedia',
        ]);

        Produk::create([
            'nama' => 'Teh Kayu Aro Kerinci',
            'harga' => 65000,
            'kategori' => 'Minuman',
            'deskripsi' => 'Teh hitam premium dari perkebunan tertinggi di Asia Tenggara.',
            'berat' => '100 gram',
            'stok' => 'Tersedia',
        ]);

        Produk::create([
            'nama' => 'Kopi Arabika Kerinci',
            'harga' => 120000,
            'kategori' => 'Minuman',
            'deskripsi' => 'Kopi arabika single origin Kerinci dengan notes cokelat dan buah tropis.',
            'berat' => '200 gram',
            'stok' => 'Tersedia',
        ]);

        Produk::create([
            'nama' => 'Madu Hutan Kerinci',
            'harga' => 150000,
            'kategori' => 'Kesehatan',
            'deskripsi' => 'Madu murni hutan Kerinci tanpa campuran.',
            'berat' => '500 ml',
            'stok' => 'Tersedia',
        ]);

        Produk::create([
            'nama' => 'Kentang Kerinci Organik',
            'harga' => 25000,
            'kategori' => 'Sayuran',
            'deskripsi' => 'Kentang segar organik dari ladang dataran tinggi Kerinci.',
            'berat' => '1 kg',
            'stok' => 'Tersedia',
        ]);

        Produk::create([
            'nama' => 'Cabai Merah Kerinci',
            'harga' => 30000,
            'kategori' => 'Sayuran',
            'deskripsi' => 'Cabai merah segar berkualitas tinggi.',
            'berat' => '500 gram',
            'stok' => 'Tersedia',
        ]);
    }
}