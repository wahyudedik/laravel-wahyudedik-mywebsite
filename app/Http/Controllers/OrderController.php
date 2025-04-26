<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderNotification;
use App\Models\User;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'whatsapp' => 'required|string|max:20',
                'license_type' => 'required|in:user,developer',
            ]);
            
            $product = Product::findOrFail($request->product_id);
            
            $amount = $request->license_type === 'user' 
                ? $product->price_user 
                : $product->price_developer;
                
            $order = Order::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
                'license_type' => $request->license_type,
                'amount' => $amount,
                'status' => 'pending',
            ]);
            
            // Notify admin about new order
            $admins = User::where('is_admin', true)->get();
            Notification::send($admins, new NewOrderNotification($order));
            
            // Generate WhatsApp message with payment instructions
            $whatsappMessage = $this->generateWhatsAppMessage($order);
            
            return redirect()->route('orders.payment', $order->order_number)
                ->with('whatsapp_message', $whatsappMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }
    
    public function payment($orderNumber)
    {
        try {
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            return view('products.payment', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Order not found: ' . $e->getMessage());
        }
    }
    
    public function uploadProof(Request $request, $orderNumber)
    {
        try {
            $request->validate([
                'payment_proof' => 'required|image|max:2048',
                'notes' => 'nullable|string|max:500',
            ]);
            
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            
            if ($request->hasFile('payment_proof')) {
                $path = $request->file('payment_proof')->store('payment_proofs', 'public');
                $order->update([
                    'payment_proof' => $path,
                    'payment_proof_uploaded_at' => now(),
                    'notes' => $request->notes,
                    'status' => 'paid',
                ]);
            }
            
            // Generate WhatsApp confirmation message
            $whatsappMessage = $this->generateConfirmationMessage($order);
            
            return redirect()->route('orders.confirmation', $order->order_number)
                ->with('success', 'Payment proof uploaded successfully! We will process your order soon.')
                ->with('whatsapp_message', $whatsappMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload payment proof: ' . $e->getMessage());
        }
    }
    
    public function confirmation($orderNumber)
    {
        try {
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            return view('orders.confirmation', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Order not found: ' . $e->getMessage());
        }
    }
    
    public function status($orderNumber)
    {
        try {
            $order = Order::where('order_number', $orderNumber)->firstOrFail();
            return view('orders.status', compact('order'));
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Order not found: ' . $e->getMessage());
        }
    }
    
    private function generateWhatsAppMessage($order)
    {
        try {
            $message = "Hello! I'd like to purchase *{$order->product->name}* with *" . ucfirst($order->license_type) . " License*.\n\n";
            $message .= "Order Number: *{$order->order_number}*\n";
            $message .= "Amount: *$" . number_format($order->amount, 2) . "*\n\n";
            $message .= "Please provide payment instructions. Thank you!";
            
            return urlencode($message);
        } catch (\Exception $e) {
            return '';
        }
    }
    
    private function generateConfirmationMessage($order)
    {
        try {
            $message = "Hello! I've completed the payment for my order.\n\n";
            $message .= "Order Number: *{$order->order_number}*\n";
            $message .= "Product: *{$order->product->name}*\n";
            $message .= "License: *" . ucfirst($order->license_type) . "*\n";
            $message .= "Amount: *$" . number_format($order->amount, 2) . "*\n\n";
            $message .= "I've uploaded the payment proof through your website. Please verify and process my order. Thank you!";
            
            return urlencode($message);
        } catch (\Exception $e) {
            return '';
        }
    }
}
