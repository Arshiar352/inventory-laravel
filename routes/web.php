
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
    ->whereNumber('id')
    ->name('products.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])
    ->whereNumber('id')
    ->name('products.update');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->whereNumber('id')
    ->name('products.show');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->whereNumber('id')
    ->name('products.destroy');
