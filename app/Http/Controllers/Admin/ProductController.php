<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'main_category' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'allow_preorder' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['allow_preorder'] = $request->has('allow_preorder');

        // Calculate discounted price
        if ($validated['discount_percentage'] > 0) {
            $validated['discounted_price'] = $validated['price'] * (1 - $validated['discount_percentage'] / 100);
        }

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = 'product_image_' . ($index + 1) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $filename, 'public');
                $images[] = $path;
            }
        }
        $validated['images'] = $images;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'main_category' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'allow_preorder' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['allow_preorder'] = $request->has('allow_preorder');

        // Calculate discounted price
        if ($validated['discount_percentage'] > 0) {
            $validated['discounted_price'] = $validated['price'] * (1 - $validated['discount_percentage'] / 100);
        } else {
            $validated['discounted_price'] = null;
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $index => $image) {
                $filename = 'product_image_' . ($index + 1) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $filename, 'public');
                $images[] = $path;
            }
            $validated['images'] = $images;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete product images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function checkAvailability()
    {
        $outOfStock = Product::where('quantity', 0)->get();
        $lowStock = Product::where('quantity', '>', 0)->where('quantity', '<=', 5)->get();
        $preorders = Product::where('allow_preorder', true)->where('quantity', 0)->get();

        return view('admin.products.availability', compact('outOfStock', 'lowStock', 'preorders'));
    }
}
