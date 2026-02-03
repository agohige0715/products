<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');
        if ($sort === 'price_asc') {
            $products = Product::orderBy('price', 'asc')->get();
        } elseif ($sort === 'price_desc') {
            $products = Product::orderBy('price', 'desc')->get();
        } else {
            $products = Product::all();
        }
        return view('products.index', compact('products', 'sort'));
    }

    public function create()
    {
        return view('products.register');
    }

    public function store(Request $request)
    {
        Product::create([
            'name'  => $request->name,
            'price' => $request->price,
        ]);
        return redirect('/products');
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);
        return redirect('/products/' . $productId);
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect('/products');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->query('sort'); // ← 追加
        $query = Product::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }
        $products = $query->get();
        return view('products.index', compact('products', 'sort'));
    }
}
