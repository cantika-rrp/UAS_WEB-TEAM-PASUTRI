<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // 1. API REGISTER
    // 1. PROSES DAFTAR (REGISTER)
public function register(Request $request)
{
    $validated = $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|string|email|max:255|unique:users',
        'password'     => 'required|string|min:8',
        'phone_number' => 'required|string',
    ]);

    // Generate 6 digit angka acak untuk OTP
    $otpCode = rand(100000, 999999);

    // Simpan user ke database (status belum diverifikasi)
    $user = User::create([
        'name'              => $validated['name'],
        'email'             => $validated['email'],
        'password'          => Hash::make($validated['password']),
        'phone_number'      => $validated['phone_number'],
        'verification_code' => $otpCode,
        'is_verified'       => false,
    ]);

    // KIRIM EMAIL OTP MENGGUNAKAN MAIL RAW (Praktis tanpa file blade tambahan)
    Mail::raw("Halo {$user->name},\n\nKode verifikasi pendaftaran akun EDC LAB Anda adalah: {$otpCode}\n\nJangan bagikan kode ini kepada siapa pun.", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Kode Verifikasi Akun EDC LAB');
    });

    return response()->json([
        'message' => 'Registrasi berhasil! Silakan cek email Anda untuk melihat kode verifikasi.'
    ], 201);
}

// 2. PROSES VERIFIKASI KODE OTP
public function verifyEmail(Request $request)
{
    $request->validate([
        'email'             => 'required|email',
        'verification_code' => 'required|string',
    ]);

    // Cari user berdasarkan email dan kodenya
    $user = User::where('email', $request->email)
                ->where('verification_code', $request->verification_code)
                ->first();

    if (!$user) {
        return response()->json(['message' => 'Kode verifikasi salah atau email tidak terdaftar.'], 400);
    }

    // Jika benar, ubah status akun menjadi aktif/terverifikasi
    $user->is_verified = true;
    $user->verification_code = null; // Hapus kode OTP karena sudah tidak dipakai
    $user->save();

    // Buat token login otomatis agar user langsung masuk ke aplikasi
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message'      => 'Akun berhasil diverifikasi!',
        'access_token' => $token,
        'token_type'   => 'Bearer'
    ], 200);

    if (!$user->is_verified) {
    return response()->json(['message' => 'Akun Anda belum diverifikasi. Silakan cek email Anda.'], 403);
    }
}