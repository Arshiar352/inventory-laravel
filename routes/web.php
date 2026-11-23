
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(
    function () {

        Route::get('/', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::get('/login', [AuthController::class, 'showLogin'])
            ->name('login');

        Route::get('/register', [AuthController::class, 'showRegister'])
            ->name('register.show');

        Route::post('/register', [AuthController::class, 'register'])
            ->name('register.create');

        Route::post('/login', [AuthController::class, 'login'])
            ->name('login.submit');
    }
);

Route::middleware('auth')->group(
    function () {

        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

        Route::get('/profile', [UserController::class, 'profile'])
            ->name('profile');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

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

        Route::put('/profile', [UserController::class, 'updateProfile'])
            ->name('profile.update');
    }
);
