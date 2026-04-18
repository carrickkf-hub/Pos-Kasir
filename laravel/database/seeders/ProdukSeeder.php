<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat kategori dulu jika belum ada
        $kategori1 = Kategori::firstOrCreate(['nama' => 'Makanan']);
        $kategori2 = Kategori::firstOrCreate(['nama' => 'Minuman']);
        $kategori3 = Kategori::firstOrCreate(['nama' => 'Elektronik']);

        // Buat produk dummy
        Produk::create([
            'nama' => 'Nasi Goreng',
            'deskripsi' => 'Nasi goreng spesial dengan telur dan ayam',
            'harga_beli' => 15000,
            'harga_jual' => 25000,
            'stok' => 50,
            'stok_awal' => 50,
            'kategori_id' => $kategori1->id
        ]);

        Produk::create([
            'nama' => 'Ayam Bakar',
            'deskripsi' => 'Ayam bakar dengan bumbu special',
            'harga_beli' => 20000,
            'harga_jual' => 35000,
            'stok' => 30,
            'stok_awal' => 30,
            'kategori_id' => $kategori1->id
        ]);

        Produk::create([
            'nama' => 'Es Teh Manis',
            'deskripsi' => 'Es teh manis segar',
            'harga_beli' => 3000,
            'harga_jual' => 5000,
            'stok' => 100,
            'stok_awal' => 100,
            'kategori_id' => $kategori2->id
        ]);

        Produk::create([
            'nama' => 'Jus Jeruk',
            'deskripsi' => 'Jus jeruk asli tanpa gula tambahan',
            'harga_beli' => 5000,
            'harga_jual' => 8000,
            'stok' => 75,
            'stok_awal' => 75,
            'kategori_id' => $kategori2->id
        ]);

        Produk::create([
            'nama' => 'Headphone Wireless',
            'deskripsi' => 'Headphone wireless dengan kualitas suara premium',
            'harga_beli' => 150000,
            'harga_jual' => 250000,
            'stok' => 10,
            'stok_awal' => 10,
            'kategori_id' => $kategori3->id
        ]);

        Produk::create([
            'nama' => 'Power Bank',
            'deskripsi' => 'Power bank 10000mAh fast charging',
            'harga_beli' => 80000,
            'harga_jual' => 120000,
            'stok' => 5,
            'stok_awal' => 5,
            'kategori_id' => $kategori3->id
        ]);
    }
}
