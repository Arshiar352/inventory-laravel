<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return 'Products Page.';
})->name('products.index');

Route::get('/products/{id}', function ($id) {
    return 'Product ID: ' . $id;
})->name('products.show');
