<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::latest()->paginate(10);
            return view('admin.products.index', compact('products'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.products.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price_user' => 'required|numeric|min:0',
                'price_developer' => 'required|numeric|min:0',
                'category' => 'required|in:e-book,template,application',
                'image' => 'nullable|image|max:2048',
                'product_file' => 'required|file|max:1048576', // 1GB max                
                'demo_link' => 'nullable|url',
                'featured' => 'boolean',
            ]);

            $data = $request->except(['image', 'product_file']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            if ($request->hasFile('product_file')) {
                $data['file_path'] = $request->file('product_file')->store('product_files', 'public');
            }

            Product::create($data);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            return view('admin.products.show', compact('product'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error showing product: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
            return view('admin.products.edit', compact('product'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price_user' => 'required|numeric|min:0',
                'price_developer' => 'required|numeric|min:0',
                'category' => 'required|in:e-book,template,application',
                'image' => 'nullable|image|max:2048',
                'product_file' => 'nullable|file|max:50000', // 50MB max
                'demo_link' => 'nullable|url',
                'featured' => 'boolean',
            ]);

            $data = $request->except(['image', 'product_file']);

            if ($request->name !== $product->name) {
                $data['slug'] = Str::slug($request->name);
            }

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                $data['image'] = $request->file('image')->store('products', 'public');
            }

            if ($request->hasFile('product_file')) {
                if ($product->file_path) {
                    Storage::disk('public')->delete($product->file_path);
                }

                $data['file_path'] = $request->file('product_file')->store('product_files', 'public');
            }

            $product->update($data);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
