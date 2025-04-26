<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompletedNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = Order::with('product')->latest()->paginate(10);
            return view('admin.orders.index', compact('orders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch orders: ' . $e->getMessage());
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
    public function show(Order $order)
    {
        try {
            return view('admin.orders.show', compact('order'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to display order: ' . $e->getMessage());
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
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,completed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        $oldStatus = $order->status;
        
        // If status is changing to completed, generate download token
        if ($request->status == 'completed' && $oldStatus != 'completed') {
            $order->download_token = Str::random(64);
        
            // Send notification email to customer
            Notification::route('mail', $order->email)
                ->notify(new OrderCompletedNotification($order));
        }
        
        $order->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'download_token' => $order->download_token,
        ]);
        
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
