<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alamat', function () {
    return view('alamat');
});

Route::get('/penjualan', function () {
    return view('penjualan');
});

Route::get('/products', function () {
    $product = Product::get();

    return response()->json($product);
});
