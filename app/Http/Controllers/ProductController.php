<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    private function getCacheVersion()
    {
        return Cache::get('products_cache_version', 1);
    }


    private function clearProductsCache()
    {
        $version = $this->getCacheVersion();

        Cache::forever('products_cache_version', $version + 1);
    }


    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $version = $this->getCacheVersion();

        $cacheKey = 'products_array_v' . $version . '_' . md5($search ?: 'all');

        $products = Cache::rememberForever($cacheKey, function () use ($search) {

            $query = Product::query();

            if ($search !== '') {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('manufacturer', 'LIKE', '%' . $search . '%')
                        ->orWhere('type', 'LIKE', '%' . $search . '%');
                });
            }

            return $query->get()->toArray();
        });

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

        $this->clearProductsCache();

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

        $this->clearProductsCache();

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

        $this->clearProductsCache();

        return redirect()
            ->route('products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }
}
