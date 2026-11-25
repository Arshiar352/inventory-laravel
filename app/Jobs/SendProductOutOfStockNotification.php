<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductOutOfStockNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendProductOutOfStockNotification implements ShouldQueue
{
    use Queueable;

    public int $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    public function handle(): void
    {
        $product = Product::find($this->productId);

        if (!$product || $product->quantity != 0) {
            return;
        }

        User::query()->chunkById(100, function ($users) use ($product) {

            foreach ($users as $user) {

                $user->notify(
                    new ProductOutOfStockNotification($product->name)
                );
            }
        });
    }
}
