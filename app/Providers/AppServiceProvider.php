<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {

            $notifications = collect();
            $unreadNotificationsCount = 0;

            if (Auth::check()) {
                $user = Auth::user();

                $notifications = $user->notifications()
                    ->latest()
                    ->take(5)
                    ->get();

                $unreadNotificationsCount = $user->unreadNotifications()->count();
            }

            $view->with([
                'notifications' => $notifications,
                'unreadNotificationsCount' => $unreadNotificationsCount,
            ]);
        });
    }
}
