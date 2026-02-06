<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /* 一覧＋並び替え */
    public function index(Request $request)
    {
        $sort = $request->query('sort');

        $products = Product::query();

        if ($sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        }

        return view('products.index', [
            'products' => $products->get(),
            'sort' => $sort,
        ]);
    }

    /* 検索 */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
        $sort = $request->query('sort');

        $products = Product::where('name', 'like', "%{$keyword}%");

        if ($sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        }

        return view('products.index', [
            'products' => $products->get(),
            'sort' => $sort,
        ]);
    }

    /* 登録画面 */
    public function register()
    {
        $seasons = Season::all();

        return view('products.register', compact('seasons'));
    }

    /* 登録処理 */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'season_id' => 'nullable|exists:seasons,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->season_id) {
            $product->seasons()->sync([$request->season_id]);
        }

        return redirect('/products');
    }

    /* 詳細 */
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);

        return view('products.show', compact('product'));
    }

    /* 編集画面 */
    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();

        return view('products.edit', compact('product', 'seasons'));
    }

    /* 更新 */
    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'season_id' => 'nullable|exists:seasons,id',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        if ($request->season_id) {
            $product->seasons()->sync([$request->season_id]);
        } else {
            $product->seasons()->detach();
        }

        return redirect("/products/{$productId}");
    }

    /* 削除 */
    public function delete($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect('/products');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
