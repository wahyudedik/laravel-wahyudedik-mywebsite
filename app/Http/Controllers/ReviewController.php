<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'order_id' => 'required|exists:orders,id'
        ]);
        
        $order = Order::findOrFail($request->order_id);
        
        // Verifikasi bahwa order ini milik pengguna yang memberikan review
        if ($order->email !== $request->email && $order->product_id !== $product->id) {
            return redirect()->back()->with('error', 'You are not authorized to review this product.');
        }
        
        // Cek apakah sudah pernah review
        $existingReview = Review::where('order_id', $order->id)->first();
        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }
        
        // Buat review baru
        $review = Review::create([
            'product_id' => $product->id,
            'order_id' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Atau false jika ingin dimoderasi dulu
        ]);
        
        // Recalculate product rating
        $product->recalculateRating();
        
        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
