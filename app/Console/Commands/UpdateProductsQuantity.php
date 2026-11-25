<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

#[Signature('app:update-products-quantity')]
#[Description('Set all products quantity to 10')]
class UpdateProductsQuantity extends Command
{

    public function handle()
    {
        $updatedCount =  Product::query()->update([
            'quantity' => 10
        ]);

        Cache::tags(['product'])->flush();

        $this->info($updatedCount);
        $this->info('All products quantity updated to 10!');
    }
}
