<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $cacheKey = 'products_' . md5($search ?: 'all');

        $products = Cache::tags(['product'])->remember(
            $cacheKey,
            now()->addMinutes(5),
            function () use ($search) {

                $query = Product::query();

                if ($search !== '') {
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('manufacturer', 'LIKE', '%' . $search . '%')
                            ->orWhere('type', 'LIKE', '%' . $search . '%');
                    });
                }

                return $query->get()->toArray();
            }
        );

        return view('products.index', compact('products'));
    }

    public function show(int $id)
    {
        return 'Product ID: ' . $id;
    }



    public function create()
    {
        return view('products.create');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'manufacturer' => 'required',
            'type' => 'required',
        ]);

        Product::create($validated);
        Cache::tags(['product'])->flush();

        return redirect()
            ->route('products.index')
            ->with('success', 'محصول با موفقیت ثبت شد.');
    }



    public function edit(int $id)
    {
        $product = Product::find($id);

        if (! $product) {
            abort(404);
        }

        return view('products.edit', compact('product'));
    }



    public function update(Request $request, int $id)
    {
        $product = Product::find($id);

        if (! $product) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'manufacturer' => 'required',
            'type' => 'required',
        ]);

        $product->update($validated);
        Cache::tags(['product'])->flush();

        return redirect()
            ->route('products.index')
            ->with('success', 'محصول با موفقیت ویرایش شد.');
    }



    public function destroy(int $id)
    {
        $product = Product::find($id);

        if (! $product) {
            abort(404);
        }

        $product->delete();
        Cache::tags(['product'])->flush();

        return redirect()
            ->route('products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }
}
