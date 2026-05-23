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
    Schema::create('case_materials', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Hardcase, Softcase, Premium Glass
        $table->integer('additional_price')->default(0); // Biaya tambahan untuk bahan tertentu
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_materials');
    }
};
