<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_nama' => 'Laptop', 'harga' => 8000000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_nama' => 'Smartphone', 'harga' => 5000000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_nama' => 'Kaos', 'harga' => 100000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_nama' => 'Jaket', 'harga' => 250000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_nama' => 'Roti', 'harga' => 15000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_nama' => 'Nasi Kotak', 'harga' => 30000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_nama' => 'Kopi', 'harga' => 20000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_nama' => 'Teh Botol', 'harga' => 10000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_nama' => 'Meja', 'harga' => 500000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_nama' => 'Kursi', 'harga' => 300000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
