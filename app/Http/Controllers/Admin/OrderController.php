<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderItems.product.category']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->latest()->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.product.category']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,completed'
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // Send email notification to customer about status change
        $this->sendStatusUpdateEmail($order, $oldStatus, $validated['status']);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function preorders(Request $request)
    {
        $query = Order::where('is_preorder', true)->with(['orderItems.product.category']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }
        
        $preorders = $query->latest()->paginate(15);
        
        return view('admin.orders.preorders', compact('preorders'));
    }

    public function notifyPreorder(Request $request, Order $order)
    {
        if (!$order->is_preorder) {
            return response()->json(['success' => false, 'message' => 'Not a pre-order']);
        }

        // Check if products are now in stock
        $inStock = $order->orderItems->every(function($item) {
            return $item->product && $item->product->quantity >= $item->quantity;
        });

        if ($inStock) {
            // Send stock availability notification
            $this->sendPreorderNotification($order);
            return response()->json(['success' => true, 'message' => 'Notification sent successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Products still out of stock']);
    }

    public function cancelPreorder(Request $request, Order $order)
    {
        if (!$order->is_preorder) {
            return response()->json(['success' => false, 'message' => 'Not a pre-order']);
        }

        $order->update(['status' => 'cancelled']);
        
        // Send cancellation email
        $this->sendCancellationEmail($order);
        
        return response()->json(['success' => true, 'message' => 'Pre-order cancelled successfully']);
    }

    public function convertPreorder(Request $request, Order $order)
    {
        if (!$order->is_preorder) {
            return response()->json(['success' => false, 'message' => 'Not a pre-order']);
        }

        // Check stock availability
        $canFulfill = $order->orderItems->every(function($item) {
            return $item->product && $item->product->quantity >= $item->quantity;
        });

        if (!$canFulfill) {
            return response()->json(['success' => false, 'message' => 'Insufficient stock']);
        }

        // Convert to regular order
        $order->update([
            'is_preorder' => false,
            'status' => 'processing'
        ]);

        // Reduce stock quantities
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->decrement('quantity', $item->quantity);
            }
        }

        // Send conversion notification
        $this->sendConversionEmail($order);

        return response()->json(['success' => true, 'message' => 'Pre-order converted to regular order']);
    }

    private function sendStatusUpdateEmail(Order $order, string $oldStatus, string $newStatus)
    {
        // Email logic would go here
        // For now, we'll just log it
        \Log::info("Order {$order->order_number} status changed from {$oldStatus} to {$newStatus}");
    }

    private function sendPreorderNotification(Order $order)
    {
        // Email logic for pre-order stock notification
        \Log::info("Pre-order notification sent for order {$order->order_number}");
    }

    private function sendCancellationEmail(Order $order)
    {
        // Email logic for cancellation
        \Log::info("Cancellation email sent for order {$order->order_number}");
    }

    private function sendConversionEmail(Order $order)
    {
        // Email logic for pre-order conversion
        \Log::info("Conversion email sent for order {$order->order_number}");
    }
}
