<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Jalankan migration untuk menambah kolom.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita tambahkan nullable() agar user lama tidak error karena kolom ini kosong di awal
            $table->string('phone_number')->nullable()->after('email'); 
            $table->date('birth_date')->nullable()->after('phone_number');
            $table->string('profile_picture')->nullable()->after('birth_date'); 
        });
    }

    /**
     * Batalkan migration (jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kembali kolom jika terjadi kesalahan
            $table->dropColumn(['phone_number', 'birth_date', 'profile_picture']);
        });
    }
}