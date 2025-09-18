@extends('layouts.admin')

@section('title', 'Order Details')
@section('page-title', 'Order #' . $order->order_number)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.orders.index') }}" class="btn-ayurveda px-4 py-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Orders
            </a>
            
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                    'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                    'delivered' => 'bg-green-100 text-green-800 border-green-200',
                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                    'completed' => 'bg-primary-100 text-primary-800 border-primary-200'
                ];
                $statusClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
            @endphp
            
            <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full border {{ $statusClass }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
        
        <div class="flex space-x-3">
            <button onclick="window.print()" class="btn-3d px-4 py-2">
                <i class="fas fa-print mr-2"></i>Print
            </button>
            
            <div class="relative group">
                <button class="btn-ayurveda px-4 py-2">
                    <i class="fas fa-edit mr-2"></i>Update Status
                </button>
                
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-earth-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                    <div class="p-2">
                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'completed'] as $status)
                            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="inline w-full">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $status }}">
                                <button type="submit" 
                                        class="w-full text-left px-3 py-2 text-sm text-earth-700 hover:bg-primary-50 rounded-lg transition-colors {{ $order->status === $status ? 'bg-primary-100 font-semibold' : '' }}">
                                    {{ ucfirst($status) }}
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Details -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Order Items -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">Order Items</h3>
            
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl border border-primary-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-spa text-white text-xl"></i>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold text-earth-800">{{ $item->product->name ?? 'Product' }}</h4>
                                <p class="text-sm text-earth-600">{{ $item->product->category->name ?? 'Category' }}</p>
                                <p class="text-xs text-earth-500">SKU: {{ $item->product->slug ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <p class="text-sm text-earth-600">Quantity</p>
                                    <p class="font-semibold text-earth-800">{{ $item->quantity }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-earth-600">Unit Price</p>
                                    <p class="font-semibold text-earth-800">${{ number_format($item->price, 2) }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-earth-600">Total</p>
                                    <p class="font-bold text-primary-600">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Order Summary -->
            <div class="mt-8 pt-6 border-t border-earth-200">
                <div class="flex justify-end">
                    <div class="w-64 space-y-3">
                        <div class="flex justify-between text-earth-600">
                            <span>Subtotal:</span>
                            <span>${{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between text-earth-600">
                            <span>Shipping:</span>
                            <span>$0.00</span>
                        </div>
                        
                        <div class="flex justify-between text-earth-600">
                            <span>Tax:</span>
                            <span>$0.00</span>
                        </div>
                        
                        <div class="border-t border-earth-200 pt-3">
                            <div class="flex justify-between text-lg font-bold text-earth-800">
                                <span>Total:</span>
                                <span class="gradient-text">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Timeline -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">Order Timeline</h3>
            
            <div class="space-y-6">
                @php
                    $timeline = [
                        ['status' => 'pending', 'title' => 'Order Placed', 'description' => 'Order has been received and is being processed', 'icon' => 'fas fa-shopping-cart'],
                        ['status' => 'processing', 'title' => 'Processing', 'description' => 'Order is being prepared for shipment', 'icon' => 'fas fa-cog'],
                        ['status' => 'shipped', 'title' => 'Shipped', 'description' => 'Order has been shipped and is on the way', 'icon' => 'fas fa-shipping-fast'],
                        ['status' => 'delivered', 'title' => 'Delivered', 'description' => 'Order has been successfully delivered', 'icon' => 'fas fa-check-circle'],
                    ];
                    
                    $currentStatusIndex = array_search($order->status, array_column($timeline, 'status'));
                @endphp
                
                @foreach($timeline as $index => $step)
                    @php
                        $isCompleted = $index <= $currentStatusIndex;
                        $isCurrent = $index === $currentStatusIndex;
                    @endphp
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white' : 'bg-earth-200 text-earth-500' }}">
                                <i class="{{ $step['icon'] }} text-lg"></i>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold {{ $isCompleted ? 'text-primary-600' : 'text-earth-600' }}">
                                        {{ $step['title'] }}
                                    </h4>
                                    <p class="text-sm text-earth-500">{{ $step['description'] }}</p>
                                </div>
                                
                                @if($isCurrent)
                                    <span class="px-3 py-1 bg-primary-100 text-primary-800 text-xs font-semibold rounded-full">
                                        Current
                                    </span>
                                @elseif($isCompleted)
                                    <span class="text-primary-600">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if(!$loop->last)
                        <div class="ml-6 w-0.5 h-6 {{ $isCompleted ? 'bg-primary-300' : 'bg-earth-200' }}"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Customer & Shipping Info -->
    <div class="space-y-8">
        <!-- Customer Information -->
        <div class="glass rounded-3xl shadow-xl p-6 border border-earth-200">
            <h3 class="text-xl font-bold gradient-text mb-4">Customer Information</h3>
            
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user text-primary-600"></i>
                    <div>
                        <p class="font-semibold text-earth-800">{{ $order->customer_name }}</p>
                        <p class="text-sm text-earth-600">Customer</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <i class="fas fa-envelope text-primary-600"></i>
                    <div>
                        <p class="font-semibold text-earth-800">{{ $order->customer_email }}</p>
                        <p class="text-sm text-earth-600">Email</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <i class="fas fa-phone text-primary-600"></i>
                    <div>
                        <p class="font-semibold text-earth-800">{{ $order->customer_phone ?? 'Not provided' }}</p>
                        <p class="text-sm text-earth-600">Phone</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Shipping Address -->
        <div class="glass rounded-3xl shadow-xl p-6 border border-earth-200">
            <h3 class="text-xl font-bold gradient-text mb-4">Shipping Address</h3>
            
            <div class="space-y-2">
                <p class="font-semibold text-earth-800">{{ $order->shipping_address ?? $order->customer_name }}</p>
                <p class="text-earth-600">{{ $order->shipping_city ?? 'City not provided' }}</p>
                <p class="text-earth-600">{{ $order->shipping_state ?? 'State' }}, {{ $order->shipping_zip ?? 'ZIP' }}</p>
                <p class="text-earth-600">{{ $order->shipping_country ?? 'Country' }}</p>
            </div>
        </div>
        
        <!-- Payment Information -->
        <div class="glass rounded-3xl shadow-xl p-6 border border-earth-200">
            <h3 class="text-xl font-bold gradient-text mb-4">Payment Information</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-earth-600">Payment Method:</span>
                    <span class="font-semibold text-earth-800">{{ $order->payment_method ?? 'Credit Card' }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-earth-600">Payment Status:</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                        Paid
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-earth-600">Transaction ID:</span>
                    <span class="font-mono text-sm text-earth-800">{{ $order->transaction_id ?? 'TXN' . $order->id . time() }}</span>
                </div>
            </div>
        </div>
        
        <!-- Order Actions -->
        <div class="glass rounded-3xl shadow-xl p-6 border border-earth-200">
            <h3 class="text-xl font-bold gradient-text mb-4">Quick Actions</h3>
            
            <div class="space-y-3">
                <button class="w-full btn-3d py-3">
                    <i class="fas fa-envelope mr-2"></i>Send Email Update
                </button>
                
                <button class="w-full btn-ayurveda py-3">
                    <i class="fas fa-truck mr-2"></i>Generate Shipping Label
                </button>
                
                <button class="w-full bg-gray-200 hover:bg-gray-300 text-earth-700 font-semibold py-3 px-4 rounded-2xl transition-colors">
                    <i class="fas fa-undo mr-2"></i>Process Refund
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; }
        .glass { background: white !important; border: 1px solid #ccc !important; }
    }
</style>
@endsection
