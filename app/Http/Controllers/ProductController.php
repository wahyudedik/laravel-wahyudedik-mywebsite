<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $category = $request->category;
            $query = Product::query();

            if ($category && $category !== 'all') {
                $query->where('category', $category);
            }

            $products = $query->latest()->paginate(9);

            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching products: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();

            // Get related products (same category, excluding current product)
            $relatedProducts = Product::where('category', $product->category)
                ->where('id', '!=', $product->id)
                ->take(4)  // Limit to 4 related products
                ->get();

            // Get approved reviews for this product
            $reviews = Review::where('product_id', $product->id)
                ->where('is_approved', true)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('products.show', compact('product', 'relatedProducts', 'reviews'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching the product: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Download the product file.
     */
    public function download($orderNumber, $token)
    {
        try {
            $order = Order::where('order_number', $orderNumber)
                ->where('download_token', $token)
                ->where('status', 'completed')
                ->firstOrFail();
            
            $product = $order->product;
        
            if (!$product->file_path || !Storage::disk('public')->exists($product->file_path)) {
                return back()->with('error', 'Product file not found. Please contact support.');
            }
        
            return Storage::disk('public')->download($product->file_path, $product->name . '.' . pathinfo($product->file_path, PATHINFO_EXTENSION));
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Invalid or expired download link.');
        }
    }
}
