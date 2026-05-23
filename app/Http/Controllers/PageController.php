<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Data dummy produk
    private $products = [
        ['id' => 1, 'name' => 'Snoopy by Marlina', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/FFB6C1/000000?text=Case+1'],
        ['id' => 2, 'name' => 'Cute dog by Silvia', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/ADD8E6/000000?text=Case+2'],
        ['id' => 3, 'name' => 'Kiddo by Khansa', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/90EE90/000000?text=Case+3'],
        ['id' => 4, 'name' => 'Random retro by Van', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/FFA07A/000000?text=Case+4'],
        ['id' => 5, 'name' => 'Duckie by Casya', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/FFFFE0/000000?text=Case+5'],
        ['id' => 6, 'name' => 'Aesthetic cat by Cello', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/D3D3D3/000000?text=Case+6'],
        ['id' => 7, 'name' => 'Ocean blue by Fairuz', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/87CEFA/000000?text=Case+7'],
        ['id' => 8, 'name' => 'Cutie pie by Chelia', 'price' => 39000, 'image' => 'https://via.placeholder.com/150/FFC0CB/000000?text=Case+8'],
    ];

    public function landing()
    {
        return view('landing', ['products' => $this->products]);
    }

    public function gallery()
    {
        return view('gallery', ['products' => $this->products]);
    }
}