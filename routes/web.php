
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::redirect('/', '/login');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register.show');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.create');
});


Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    Route::put('/profile', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');



    Route::middleware('permission:view products')->group(function () {

        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/{id}', [ProductController::class, 'show'])
            ->whereNumber('id')
            ->name('products.show');
    });



    Route::middleware('role:admin')->group(function () {

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
    });


    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
});
