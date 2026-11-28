<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductOutOfStockNotification;

class ProductObserver
{
    public function created(Product $product): void
    {
        if ($product->quantity == 0) {
            $this->notifyAdmins($product);
        }
    }

    public function updated(Product $product): void
    {
        if (
            $product->wasChanged('quantity')
            && $product->getOriginal('quantity') > 0
            && $product->quantity == 0
        ) {
            $this->notifyAdmins($product);
        }
    }

    private function notifyAdmins(Product $product): void
    {
        foreach (User::role('admin')->get() as $admin) {
            $admin->notify(new ProductOutOfStockNotification($product->name));
        }
    }

    public function deleted(Product $product): void
    {
        //
    }

    public function restored(Product $product): void
    {
        //
    }

    public function forceDeleted(Product $product): void
    {
        //
    }
}
