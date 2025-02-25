<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Penjualan_DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Transaksi 1
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'jumlah' => 1, 'subtotal' => 8000000], // Laptop
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 3, 'jumlah' => 2, 'subtotal' => 200000],  // Kaos
            ['detail_id' => 3, 'penjualan_id' => 1, 'barang_id' => 7, 'jumlah' => 3, 'subtotal' => 60000],   // Kopi

            // Transaksi 2
            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 2, 'jumlah' => 1, 'subtotal' => 5000000], // Smartphone
            ['detail_id' => 5, 'penjualan_id' => 2, 'barang_id' => 4, 'jumlah' => 1, 'subtotal' => 250000],  // Jaket
            ['detail_id' => 6, 'penjualan_id' => 2, 'barang_id' => 6, 'jumlah' => 1, 'subtotal' => 30000],   // Nasi Kotak

            // Transaksi 3
            ['detail_id' => 7, 'penjualan_id' => 3, 'barang_id' => 5, 'jumlah' => 5, 'subtotal' => 75000],   // Roti
            ['detail_id' => 8, 'penjualan_id' => 3, 'barang_id' => 9, 'jumlah' => 1, 'subtotal' => 500000],  // Meja
            ['detail_id' => 9, 'penjualan_id' => 3, 'barang_id' => 10, 'jumlah' => 2, 'subtotal' => 600000], // Kursi

            // Transaksi 4
            ['detail_id' => 10, 'penjualan_id' => 4, 'barang_id' => 8, 'jumlah' => 5, 'subtotal' => 50000],   // Teh Botol
            ['detail_id' => 11, 'penjualan_id' => 4, 'barang_id' => 3, 'jumlah' => 2, 'subtotal' => 200000],  // Kaos
            ['detail_id' => 12, 'penjualan_id' => 4, 'barang_id' => 7, 'jumlah' => 1, 'subtotal' => 20000],   // Kopi

            // Transaksi 5
            ['detail_id' => 13, 'penjualan_id' => 5, 'barang_id' => 1, 'jumlah' => 1, 'subtotal' => 8000000], // Laptop
            ['detail_id' => 14, 'penjualan_id' => 5, 'barang_id' => 5, 'jumlah' => 3, 'subtotal' => 45000],   // Roti
            ['detail_id' => 15, 'penjualan_id' => 5, 'barang_id' => 6, 'jumlah' => 2, 'subtotal' => 60000],   // Nasi Kotak

            // Transaksi 6
            ['detail_id' => 16, 'penjualan_id' => 6, 'barang_id' => 2, 'jumlah' => 1, 'subtotal' => 5000000], // Smartphone
            ['detail_id' => 17, 'penjualan_id' => 6, 'barang_id' => 4, 'jumlah' => 1, 'subtotal' => 250000],  // Jaket
            ['detail_id' => 18, 'penjualan_id' => 6, 'barang_id' => 8, 'jumlah' => 2, 'subtotal' => 20000],   // Teh Botol

            // Transaksi 7
            ['detail_id' => 19, 'penjualan_id' => 7, 'barang_id' => 9, 'jumlah' => 1, 'subtotal' => 500000],  // Meja
            ['detail_id' => 20, 'penjualan_id' => 7, 'barang_id' => 10, 'jumlah' => 2, 'subtotal' => 600000], // Kursi
            ['detail_id' => 21, 'penjualan_id' => 7, 'barang_id' => 3, 'jumlah' => 3, 'subtotal' => 300000],  // Kaos

            // Transaksi 8
            ['detail_id' => 22, 'penjualan_id' => 8, 'barang_id' => 5, 'jumlah' => 5, 'subtotal' => 75000],   // Roti
            ['detail_id' => 23, 'penjualan_id' => 8, 'barang_id' => 6, 'jumlah' => 3, 'subtotal' => 90000],   // Nasi Kotak
            ['detail_id' => 24, 'penjualan_id' => 8, 'barang_id' => 7, 'jumlah' => 2, 'subtotal' => 40000],   // Kopi

            // Transaksi 9
            ['detail_id' => 25, 'penjualan_id' => 9, 'barang_id' => 1, 'jumlah' => 1, 'subtotal' => 8000000], // Laptop
            ['detail_id' => 26, 'penjualan_id' => 9, 'barang_id' => 8, 'jumlah' => 2, 'subtotal' => 20000],   // Teh Botol
            ['detail_id' => 27, 'penjualan_id' => 9, 'barang_id' => 4, 'jumlah' => 1, 'subtotal' => 250000],  // Jaket

            // Transaksi 10
            ['detail_id' => 28, 'penjualan_id' => 10, 'barang_id' => 2, 'jumlah' => 1, 'subtotal' => 5000000], // Smartphone
            ['detail_id' => 29, 'penjualan_id' => 10, 'barang_id' => 5, 'jumlah' => 4, 'subtotal' => 60000],   // Roti
            ['detail_id' => 30, 'penjualan_id' => 10, 'barang_id' => 10, 'jumlah' => 1, 'subtotal' => 300000], // Kursi
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
