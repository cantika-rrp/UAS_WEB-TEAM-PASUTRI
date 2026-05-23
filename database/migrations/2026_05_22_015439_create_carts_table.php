<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        
        // Hubungkan ke tabel users (siapa yang punya keranjang ini)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Hubungkan ke tabel products (nullable, diisi KALO dia beli dari katalog desain)
        $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        
        // Kolom khusus untuk menyimpan detail custom case pilihan user (tipe HP, warna, stiker, dll)
        // Kita pakai tipe data JSON karena data custom case bentuknya dinamis/bisa berubah-ubah
        $table->json('custom_details')->nullable();
        
        $table->integer('quantity')->default(1); // Jumlah barang yang dibeli
        $table->integer('total_price');          // Total harga (harga barang x quantity)
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
