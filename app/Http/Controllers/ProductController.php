<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $productsCount = $products->sum('quantity');

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

    public function update()
    {
        //
    }
}
