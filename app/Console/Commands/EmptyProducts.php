<?php

namespace App\Console\Commands;


use App\Models\Product;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

#[Signature('app:empty-products')]
#[Description('Set all products quantity to 0')]
class EmptyProducts extends Command
{
    public function handle()
    {
        $emptyProducts = Product::query()->update([
            'quantity' => 0,
        ]);

        Cache::tags(['product'])->flush();

        $this->info($emptyProducts);
        $this->info('All products quantity updated to 0!');
    }
}
