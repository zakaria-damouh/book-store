<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->get('category');
    
        $products = Product::with('categories')
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->paginate(10);
    
        $categories = Category::all();
    
        return view('products.index', compact('products', 'categories', 'categoryId'));
    }
    

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ref' => 'required|unique:products',
            'name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('categories', 'image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);
        $product->categories()->attach($request->categories);

        return redirect()->route('products.index')->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('categories');
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'ref' => 'required|unique:products,ref,' . $product->id,
            'name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('categories', 'image');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted');
    }

    public function filterByCategory($categoryId)
    {
        $products = Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->get();

        return view('products.index', compact('products'));
    }
}
