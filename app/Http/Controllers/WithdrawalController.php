<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->latest('id')
            ->get();

        return view('withdrawals.index', compact('withdrawals'));
    }

    public function store(Request $request, int $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $validated['quantity'];

        DB::transaction(function () use ($id, $quantity) {

            $product = Product::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if (! $product->is_active) {
                throw ValidationException::withMessages([
                    'quantity' => 'امکان برداشت از محصول غیرفعال وجود ندارد.',
                ]);
            }

            if ($product->quantity < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'مقدار درخواستی بیشتر از موجودی محصول است.',
                ]);
            }

            $product->decrement('quantity', $quantity);

            Withdrawal::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $quantity,
            ]);
        });

        Cache::tags(['product'])->flush();

        return redirect()
            ->route('products.index')
            ->with('success', 'برداشت محصول با موفقیت ثبت شد.');
    }
}
