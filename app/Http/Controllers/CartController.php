<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. LIHAT ISI KERANJANG USER (Untuk Cart Page)
    public function index()
    {
        // Ambil data keranjang milik user yang sedang login saja
        // Kita sertakan data 'product' jika barang diambil dari katalog desain
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($cartItems);
    }

    // 2. MASUKKAN BARANG KE KERANJANG (Untuk halaman detail/custom)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'     => 'nullable|exists:products,id', // Diisi kalau beli katalog biasa
            'custom_details' => 'nullable|array',              // Diisi kalau bikin custom case
            'quantity'       => 'required|integer|min:1',
            'total_price'    => 'required|integer',
        ]);

        // Tambahkan user_id yang sedang login secara otomatis
        $validated['user_id'] = Auth::id();

        // Simpan ke MySQL
        $cart = Cart::create($validated);

        return response()->json([
            'message' => 'Barang berhasil dimasukkan ke keranjang!',
            'data'    => $cart
        ], 201);
    }

    // 3. HAPUS BARANG DARI KERANJANG (Jika user klik tombol batal/hapus)
    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Barang tidak ditemukan atau bukan milik Anda.'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Barang berhasil dihapus dari keranjang!']);
    }
}