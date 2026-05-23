@extends('layouts.app')

@section('content')
<div x-data="{
    cart: {}, 
    
    // Fungsi mengubah jumlah barang (min/plus)
    updateCart(id, price, change) {
        if(!this.cart[id]) {
            this.cart[id] = { qty: 0, price: price };
        }
        this.cart[id].qty += change;
        if(this.cart[id].qty <= 0) {
            delete this.cart[id];
        }
    },

    // Fungsi mendapatkan jumlah barang spesifik
    getQty(id) {
        return this.cart[id] ? this.cart[id].qty : 0;
    },

    // Menghitung total barang
    getTotalItems() {
        let total = 0;
        for(let i in this.cart) total += this.cart[i].qty;
        return total;
    },

    // Menghitung total harga
    getTotalPrice() {
        let total = 0;
        for(let i in this.cart) total += (this.cart[i].qty * this.cart[i].price);
        return total;
    },

    // Format Rupiah
    formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }
}" class="relative pb-32">

    <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex items-center">
        <a href="{{ route('landing') }}" class="mr-4 text-gray-500 hover:text-black"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="text-xl font-bold">Katalog Desain</h1>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach($products as $product)
            <div class="bg-white p-4 rounded-xl shadow-sm text-center transition border-2" 
                 :class="getQty({{ $product['id'] }}) > 0 ? 'border-pink-200 bg-pink-50' : 'border-transparent'">
                
                <div class="bg-gray-100 rounded-xl p-2 mb-3 h-48 flex items-center justify-center">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="max-h-full rounded-xl shadow-sm">
                </div>
                
                <h3 class="text-xs font-semibold text-gray-700">{{ $product['name'] }}</h3>
                <p class="text-xs text-gray-500 mt-1 mb-3">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                
                <div class="flex items-center justify-center space-x-2">
                    <button @click="updateCart({{ $product['id'] }}, {{ $product['price'] }}, -1)" class="w-6 h-6 bg-blue-100 text-blue-600 rounded flex items-center justify-center hover:bg-blue-200">-</button>
                    <span class="text-xs font-bold w-4" x-text="getQty({{ $product['id'] }})">0</span>
                    <button @click="updateCart({{ $product['id'] }}, {{ $product['price'] }}, 1)" class="w-6 h-6 bg-blue-100 text-blue-600 rounded flex items-center justify-center hover:bg-blue-200">+</button>
                    
                    <button @click="updateCart({{ $product['id'] }}, {{ $product['price'] }}, 1)" class="w-6 h-6 bg-pink-100 text-pink-600 rounded flex items-center justify-center hover:bg-pink-200 ml-2">
                        <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="getTotalItems() > 0" 
         x-transition.duration.300ms
         class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] rounded-t-2xl p-4 md:px-20 z-50">
        
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center">
            
            <div class="w-full md:w-auto mb-4 md:mb-0 space-y-1">
                <div class="flex text-sm text-gray-600">
                    <span class="w-24">Total barang</span>
                    <span>: <span x-text="getTotalItems()" class="font-bold text-black"></span></span>
                </div>
                <div class="flex text-sm text-gray-600">
                    <span class="w-24">Total harga</span>
                    <span>: <span class="font-bold text-black">Rp <span x-text="formatRupiah(getTotalPrice())"></span></span></span>
                </div>
            </div>

            <div class="flex space-x-4 w-full md:w-auto justify-end">
                <button @click="cart = {}" class="px-8 py-2 border border-pink-700 text-pink-700 rounded-full hover:bg-pink-50 font-semibold transition">
                    Batal
                </button>
                <button class="px-8 py-2 bg-pink-700 text-white rounded-full hover:bg-pink-800 font-semibold transition">
                    Checkout
                </button>
            </div>
            
        </div>
    </div>

</div>
@endsection