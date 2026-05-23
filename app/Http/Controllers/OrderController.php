<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // 1. PROSES CHECKOUT (Membuat Pesanan Baru)
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'phone_number'     => 'required|string',
            'notes'            => 'nullable|string',
        ]);

        $userId = Auth::id();

        // Ambil semua item di keranjang user ini
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang belanja Anda kosong.'], 400);
        }

        // Hitung total harga dari seluruh isi keranjang
        $totalAmount = $cartItems->sum('total_price');

        // Kita gunakan DB::transaction agar jika salah satu proses gagal, database dibatalkan otomatis (aman dari error data corrupt)
        DB::transaction(function () use ($userId, $validated, $totalAmount, $cartItems) {
            
            // a. Simpan data ke tabel orders
            $order = Order::create([
                'user_id'          => $userId,
                'total_amount'     => $totalAmount,
                'shipping_address' => $validated['shipping_address'],
                'phone_number'     => $validated['phone_number'],
                'notes'            => $validated['notes'],
                'status'           => 'pending' // Status awal saat checkout
            ]);

            // b. Pindahkan setiap item dari keranjang ke tabel order_items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'       => $order->id,
                    'product_id'     => $item->product_id,
                    'custom_details' => $item->custom_details,
                    'quantity'       => $item->quantity,
                    'price'          => $item->total_price / $item->quantity, // Harga satuan
                ]);
            }

            // c. Kosongkan keranjang belanja user setelah checkout sukses
            Cart::where('user_id', $userId)->delete();
        });

        return response()->json([
            'message' => 'Checkout berhasil, pesanan Anda sedang diproses!'
        ], 201);
    }

    // 2. AMBIL RIWAYAT PESANAN (Untuk Order History Page)
    public function history()
    {
        // Ambil semua data order milik user yang login, diurutkan dari yang paling baru
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }
}