<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');