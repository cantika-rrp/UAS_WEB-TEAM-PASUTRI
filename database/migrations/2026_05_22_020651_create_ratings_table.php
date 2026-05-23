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
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke user yang memberi rating
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Menghubungkan ke produk yang dikiim (bisa dikosongkan jika casing custom)
        $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        
        $table->integer('stars'); // Nilai bintang dari 1 - 5
        $table->text('comment')->nullable(); // Ulasan teks opsional
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
