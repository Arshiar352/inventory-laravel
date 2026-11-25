<?php

namespace App\Observers;

use App\Models\Product;
use App\Jobs\SendProductOutOfStockNotification;

class ProductObserver
{
    public function created(Product $product): void
    {
        if ($product->quantity == 0) {
            SendProductOutOfStockNotification::dispatch($product->id);
        }
    }

    public function updated(Product $product): void
    {
        if ($product->wasChanged('quantity') && $product->quantity == 0) {
            SendProductOutOfStockNotification::dispatch($product->id);
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
