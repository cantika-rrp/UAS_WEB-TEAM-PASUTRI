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
    Schema::create('phone_models', function (Blueprint $table) {
        $table->id();
        $table->string('brand'); // Contoh: Apple, Samsung
        $table->string('model_name'); // Contoh: iPhone 11, iPhone 12 Pro, Galaxy S23
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_models');
    }
};
