<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Laravel Backend API',
        'status' => 'Active'
    ]);
});