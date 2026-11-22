<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {

        return 'Product ID: ' . $id;
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

        return redirect()
            ->route('products.index')
            ->with('success', 'محصول با موفقیت ثبت شد.');
    }

    public function create()
    {
        return view('products.create');
    }

    public function delete()
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
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

        return redirect()
            ->route('products.update')
            ->with('success', 'محصول با موفقیت تغییر کرد.');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('products.edit', compact('product'));
    }
}
