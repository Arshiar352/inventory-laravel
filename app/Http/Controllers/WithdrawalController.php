<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WithdrawalController extends Controller
{
    public function store(Request $request, int $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($id, $validated) {

            $product = Product::where('is_active', true)
                ->where('quantity', '>=', $validated['quantity'])
                ->lockForUpdate()
                ->findOrFail($id);

            $product->decrement('quantity', $validated['quantity']);

            Withdrawal::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $validated['quantity'],
            ]);
        });

        Cache::tags(['product'])->flush();

        return redirect()
            ->route('products.index')
            ->with('success', 'برداشت محصول با موفقیت ثبت شد.');
    }
}
